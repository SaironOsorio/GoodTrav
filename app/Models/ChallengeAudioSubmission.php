<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengeAudioSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'challenge_code',
        'audio_path',
        'status',
        'admin_feedback',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challenge_code', 'code');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
