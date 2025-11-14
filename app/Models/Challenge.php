<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'order',
        'title',
        'description',
        'points',
        'url_resource',
        'is_audio',
        'study_id',
    ];

    protected $casts = [
        'is_audio' => 'boolean',
        'points' => 'integer',
        'order' => 'integer',
    ];


    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'challenge_user',      // tabla pivot
            'challenge_code',      // FK de challenge en pivot (CODE)
            'user_id',             // FK de user en pivot
            'code',                // PK de challenges (usamos CODE)
            'id'                   // PK de users
        )
        ->withPivot(['is_completed', 'completed_at', 'points_earned', 'submission', 'submission_url'])
        ->withTimestamps();
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }


    public function isCompletedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->users()
            ->where('users.id', $user->id)
            ->wherePivot('is_completed', true)
            ->exists();
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($challenge) {
            if (empty($challenge->code)) {

                $baseCode = Str::slug($challenge->title);
                $code = $baseCode;
                $counter = 1;

                while (static::where('code', $code)->exists()) {
                    $code = $baseCode . '-' . $counter;
                    $counter++;
                }

                $challenge->code = $code;
            }
        });
    }

    public function audioSubmissions()
    {
        return $this->hasMany(ChallengeAudioSubmission::class, 'challenge_code', 'code');
    }

    public function getUserSubmission($userId)
    {
        return $this->audioSubmissions()
                    ->where('user_id', $userId)
                    ->first();
    }
}
