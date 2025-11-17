<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagesociety extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'title_card_one',
        'text_card_one',
        'title_card_two',
        'text_card_two'
    ];
}
