<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributors extends Model
{
    protected $fillable = [
        'name',
        'url',
        'imagen_path',
    ];

}
