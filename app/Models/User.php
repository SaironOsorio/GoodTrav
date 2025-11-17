<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Cashier\Billable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'student_name',
        'email',
        'is_admin',
        'password',
        'country_id',
        'country_code',
        'phone',
        'date_of_birth',
        'address',
        'stripe_id',
        'stripe_subscription_id',
        'is_on_trial',
        'gt_points',
        'subscription_start_date',
        'subscription_end_date',
        'referral_code',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'has_watched_weekly_video',
        'video_watched_at',
        'current_study_id',
        'is_society',
        'society_code',
        'is_tiktok',
        'is_instagram',
        'has_received_post_points',
        'has_received_event_points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'video_watched_at' => 'datetime',
        'has_watched_weekly_video' => 'boolean',
        'is_society' => 'boolean',
        'society_code' => 'string',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'country_code' => 'string',
            'gt_points' => 'integer',
            'subscription_start_date' => 'date',
            'subscription_end_date' => 'date',
            'referral_code' => 'string',
            'stripe_subscription_id' => 'string',
            'is_on_trial' => 'boolean',
            'trial_ends_at' => 'datetime',
            'is_admin' => 'boolean',
            'video_watched_at' => 'datetime',
            'has_watched_weekly_video' => 'boolean',
            'is_tiktok' => 'boolean',
            'is_instagram' => 'boolean',
            'has_received_post_points' => 'boolean',
            'has_received_event_points' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }

    public function challenges()
    {
        return $this->belongsToMany(
            Challenge::class,
            'challenge_user',
            'user_id',
            'challenge_code',
            'id',
            'code'
        )
        ->withPivot(['is_completed', 'completed_at', 'points_earned', 'submission', 'submission_url'])
        ->withTimestamps();
    }

    public function hasCompletedChallenge($challengeCode)
    {
        return $this->challenges()
            ->where('challenges.code', $challengeCode)
            ->wherePivot('is_completed', true)
            ->exists();
    }

    public function getTotalPointsAttribute(): int
    {
        return $this->challenges()
            ->where('is_completed', true)
            ->sum('challenge_user.points_earned');
    }

    public function reservers()
    {
        return $this->hasMany(Reserver::class);
    }

    public function society()
    {
        return $this->hasOne(Society::class);
    }

    public function completedChallenges()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_user', 'user_id', 'challenge_code', 'id', 'code')
            ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
