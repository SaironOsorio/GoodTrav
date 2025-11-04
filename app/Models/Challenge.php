<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'study_id',
        'title',
        'description',
        'points',
        'url_resource',
        'is_audio',
    ];

    protected $casts = [
        'points' => 'integer',
        'is_audio' => 'boolean',
    ];

    public function study()
    {
        return $this->belongsTo(Study::class);
    }
}
