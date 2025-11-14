<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    protected $fillable = [
        'phone',
        'instagram',
        'tiktok',
        'email',
        'whats_app',
    ];
}
