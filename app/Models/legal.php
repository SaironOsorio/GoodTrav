<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class legal extends Model
{
    protected $fillable = [
        'content-legal',
        'content-privacity',
        'content-cookies',
    ];
}
