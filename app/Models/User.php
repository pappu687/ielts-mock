<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'native_language',
        'target_band_score',
        'subscription_type',
        'subscription_expires_at',
        'profile_image',
        'timezone',
        'preferences',
     ];

    protected $casts = [
        'email_verified_at'       => 'datetime',
        'subscription_expires_at' => 'datetime',
        'preferences'             => 'array',
        'target_band_score'       => 'float',
     ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function examSessions(): HasMany
    {
        return $this->hasMany(ExamSession::class);
    }

    public function scoreHistory(): HasMany
    {
        return $this->hasMany(ScoreHistory::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function studyPlans(): HasMany
    {
        return $this->hasMany(StudyPlan::class);
    }

    public function learningAnalytics(): HasMany
    {
        return $this->hasMany(LearningAnalytics::class);

    }
}