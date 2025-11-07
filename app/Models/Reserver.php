<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserver extends Model
{
    protected $fillable = [
        'user_id',
        'name_trip',
        'date_trip',
        'total_points',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
