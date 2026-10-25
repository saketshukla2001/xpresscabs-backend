<?php

namespace App\Models\Request;

use App\Models\Admin\Driver;
use Illuminate\Database\Eloquent\Model;

class RequestDriverRing extends Model
{
    protected $table = 'request_driver_rings';

    protected $fillable = [
        'request_id',
        'driver_id',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id')->withTrashed();
    }

    public static function record($requestId, $driverId)
    {
        if (!$requestId || !$driverId) {
            return;
        }

        static::create([
            'request_id' => $requestId,
            'driver_id' => $driverId,
        ]);
    }
}
