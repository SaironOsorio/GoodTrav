<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class legal extends Model
{
    protected $fillable = [
        'content_legal',
        'content_privacy',
        'content_cookies',
        'content_terms',
    ];
}
