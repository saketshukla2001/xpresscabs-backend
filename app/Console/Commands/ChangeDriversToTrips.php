<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Request\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendRequestToNextDriversJob;
use App\Models\Request\DriverRejectedRequest;
use Kreait\Firebase\Contract\Database;

class ChangeDriversToTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:totrip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the request to other drivers when the driver doesn\'t respond';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lock = fopen(storage_path('framework/drivers-totrip.lock'), 'c');
        if ($lock === false || !flock($lock, LOCK_EX | LOCK_NB)) {
            return $this->info('already-running');
        }

        try {
            $this->deleteStaleMeta();
            $expiredRequestIds = $this->expireUnansweredOffers();
            $this->publishNextDrivers($expiredRequestIds);
            $this->reconcileFirebaseRequestMeta();
            $this->info('success');
        } catch (\Exception $e) {
            Log::error($e);
            Log::error('Error while changing requests to other drivers');
            return $this->info('unknown error occured');
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    /**
     * Drop offer rows for trips that are no longer waiting for a driver.
     */
    protected function deleteStaleMeta()
    {
        RequestMeta::whereHas('request', function ($query) {
            $query->where(function ($status) {
                $status->where('is_cancelled', 1)
                    ->orWhere('is_completed', 1)
                    ->orWhere('is_driver_started', 1)
                    ->orWhereNotNull('accepted_at');
            });
        })->delete();
    }

    /**
     * @return array<int, string>
     */
    protected function expireUnansweredOffers()
    {
        $timeout = $this->acceptWindowSeconds();
        $cutoff = Carbon::now()->subSeconds($timeout);

        $expired = RequestMeta::where('active', 1)
            ->where('updated_at', '<=', $cutoff)
            ->whereHas('request', function ($query) {
                $query->where('is_cancelled', 0)
                    ->where('is_completed', 0)
                    ->where('is_driver_started', 0)
                    ->whereNull('accepted_at');
            })
            ->get();

        if ($expired->isEmpty()) {
            return [];
        }

        $expiredRequestIds = [];

        DB::beginTransaction();
        try {
            foreach ($expired as $meta) {
                $driver = $meta->driver;
                if ($driver && !$driver->currentRide()) {
                    $driver->available = true;
                    $driver->save();
                }

                DriverRejectedRequest::firstOrCreate([
                    'request_id' => $meta->request_id,
                    'driver_id' => $meta->driver_id,
                ]);

                $expiredRequestIds[$meta->request_id] = true;
                $meta->delete();
            }

            foreach (array_keys($expiredRequestIds) as $requestId) {
                $next = RequestMeta::where('request_id', $requestId)
                    ->where('active', 0)
                    ->orderBy('id')
                    ->first();

                if ($next) {
                    $next->active = 1;
                    $next->save();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return array_keys($expiredRequestIds);
    }

    /**
     * Point Firebase at the next driver, or remove the offer when nobody is left.
     *
     * @param array<int, string> $expiredRequestIds
     */
    protected function publishNextDrivers(array $expiredRequestIds)
    {
        $nextMetaIds = [];

        foreach ($expiredRequestIds as $requestId) {
            $request = Request::find($requestId);
            if (!$request || $request->is_cancelled || $request->is_completed || $request->is_driver_started || $request->accepted_at) {
                $this->removeOfferNode($requestId);
                continue;
            }

            $next = RequestMeta::where('request_id', $requestId)
                ->where('active', 1)
                ->orderBy('id')
                ->first();

            if (!$next) {
                $this->removeOfferNode($requestId);
                continue;
            }

            $this->writeOfferNode($requestId, $next->driver_id, $next->user_id ?: $request->user_id);
            $nextMetaIds[] = $next->id;
        }

        if ($nextMetaIds) {
            dispatch(new SendRequestToNextDriversJob($nextMetaIds, $this->database));
        }
    }

    /**
     * Remove Firebase offers that no longer belong to a live, unanswered trip.
     */
    protected function reconcileFirebaseRequestMeta()
    {
        try {
            $nodes = $this->database->getReference('request-meta')->getValue();
        } catch (\Throwable $e) {
            Log::error('request-meta firebase cleanup failed: '.$e->getMessage());
            return;
        }
        if (!is_array($nodes)) {
            return;
        }

        $graceSeconds = max($this->acceptWindowSeconds(), 15);

        foreach ($nodes as $requestId => $node) {
            if (!is_string($requestId) || !is_array($node)) {
                $this->removeOfferNode($requestId);
                continue;
            }

            $request = Request::find($requestId);
            if (!$request || $request->is_cancelled || $request->is_completed || $request->is_driver_started || $request->accepted_at) {
                $this->removeOfferNode($requestId);
                continue;
            }

            $activeMeta = RequestMeta::where('request_id', $requestId)
                ->where('active', 1)
                ->orderBy('id')
                ->first();

            if (!$activeMeta) {
                $createdAt = $request->created_at ? Carbon::parse($request->created_at) : null;
                if ($createdAt && $createdAt->gt(Carbon::now()->subSeconds($graceSeconds))) {
                    continue;
                }

                $this->removeOfferNode($requestId);
                continue;
            }

            $nodeDriverId = $node['driver_id'] ?? null;
            if ((string) $nodeDriverId !== (string) $activeMeta->driver_id) {
                $this->writeOfferNode($requestId, $activeMeta->driver_id, $activeMeta->user_id ?: $request->user_id);
            }
        }
    }

    protected function writeOfferNode($requestId, $driverId, $userId)
    {
        $this->firebase(function () use ($requestId, $driverId, $userId) {
            $this->database->getReference('request-meta/'.$requestId)->set([
                'driver_id' => $driverId,
                'request_id' => $requestId,
                'user_id' => $userId,
                'active' => 1,
                'updated_at' => Database::SERVER_TIMESTAMP,
            ]);
        });
    }

    protected function removeOfferNode($requestId)
    {
        $this->firebase(function () use ($requestId) {
            $this->database->getReference('request-meta/'.$requestId)->remove();
        });
    }

    protected function firebase(callable $operation)
    {
        try {
            $operation();
        } catch (\Throwable $e) {
            Log::error('request-meta firebase cleanup failed: '.$e->getMessage());
        }
    }

    protected function acceptWindowSeconds()
    {
        $timeout = (int) get_settings('trip_accept_reject_duration_for_driver');

        return $timeout > 0 ? $timeout : 60;
    }
}
