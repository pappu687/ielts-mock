<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_type',
        'current_level',
        'target_level',
        'tests_completed',
        'average_score',
        'best_score',
        'time_spent_practicing',
        'last_activity',
        'streak_days',
        'improvement_areas',
        'achievements',
     ];

    protected $casts = [
        'current_level'     => 'float',
        'target_level'      => 'float',
        'average_score'     => 'float',
        'best_score'        => 'float',
        'last_activity'     => 'datetime',
        'improvement_areas' => 'array',
        'achievements'      => 'array',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
