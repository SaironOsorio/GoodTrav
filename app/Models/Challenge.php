<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Challenge extends Model
{
    protected $fillable = [
        'study_id',
        'code',
        'title',
        'description',
        'points',
        'url_resource',
        'is_audio',
        'order',
    ];

    protected $casts = [
        'points' => 'integer',
        'is_audio' => 'boolean',
        'order' => 'integer',
    ];

    public function study()
    {
        return $this->belongsTo(Study::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($challenge) {
            if (empty($challenge->code)) {
                $challenge->code = Str::slug($challenge->title) . '-' . Str::random(6);
            }
        });
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'challenge_user')
            ->withPivot(['is_completed', 'completed_at', 'points_earned', 'submission', 'submission_url'])
            ->withTimestamps();
    }

    public function isCompletedBy(User $user): bool
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->where('is_completed', true)
            ->exists();
    }
}
