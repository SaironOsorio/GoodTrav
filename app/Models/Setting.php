<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'url_youtube_landing',
        'title_contributors_list_title',
        'title_contributors_list_subtitle',
        'title_contributors_new_title',
        'title_contributors_new_subtitle',
        'title_contributors_price_base',
        'title_contributors_price_new',
        'event_count',
        'subcription_title',
        'subcription_description',
        'image_path_authentication',
    ];

    protected $casts = [
        'title_contributors_price_base' => 'integer',
        'title_contributors_price_new' => 'integer',
        'event_count' => 'integer',
    ];
}
