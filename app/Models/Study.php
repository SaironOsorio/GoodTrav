<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'start_date',
        'end_date',
        'url_video',
        'notes',
        'points',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'points' => 'integer',
    ];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

}
