<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserver extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
        'name_trip',
        'date_trip',
        'total_points',
        'total_price',
        'status',
        'discount',
        'phone_called_at',
    ];

    protected $casts = [
        'date_trip' => 'date',
        'phone_called_at' => 'datetime',
        'total_points' => 'integer',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
