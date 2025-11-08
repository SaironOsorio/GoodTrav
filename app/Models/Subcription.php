<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{

    protected $fillable = [
        'title',
        'price',
        'stripe_price_id',
        'duration',
        'description',
        'features',
    ];

    protected $casts = [
        'price' => 'integer',
        'features' => 'array'
    ];

}
