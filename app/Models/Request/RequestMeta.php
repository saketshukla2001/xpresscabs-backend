<?php

namespace App\Models\Request;

use Carbon\Carbon;
use App\Models\Admin\Driver;
use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class RequestMeta extends Model
{
    use HasActive;

    protected static function boot()
    {
        parent::boot();

        static::created(function (RequestMeta $meta) {
            if (!$meta->request_id) {
                return;
            }

            Request::where('id', $meta->request_id)->increment('drivers_sent_count');

            if ($meta->active) {
                Request::where('id', $meta->request_id)->increment('drivers_rang_count');
                RequestDriverRing::record($meta->request_id, $meta->driver_id);
            }
        });
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active','request_id','user_id','driver_id','assign_method','is_later','distance_to_pickup'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'request','request.requestPlace'
    ];

    /**
     * The request that the meta belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }
    /**
    * The request that the meta belongs to.
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    /**
     * Offer still waiting for this driver to accept or reject.
     * Cancelled, completed, and already accepted trips are excluded.
     */
    public function scopeIncomingForDriver($query, $driverId)
    {
        return $query->where('driver_id', $driverId)
            ->where('active', 1)
            ->whereHas('request', function ($request) {
                $request->where('is_cancelled', 0)
                    ->where('is_completed', 0)
                    ->where('is_driver_started', 0)
                    ->whereNull('accepted_at');
            });
    }

    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedUpdatedAtAttribute()
    {
        if ($this->updated_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->updated_at)->setTimezone($timezone)->format('jS M h:i A');
    }
}
