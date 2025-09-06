<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_date',
        'target_score',
        'weekly_hours',
        'focus_areas',
        'milestones',
        'current_milestone',
        'completion_percentage',
        'is_active',
     ];

    protected $casts = [
        'target_date'  => 'date',
        'target_score' => 'float',
        'focus_areas'  => 'array',
        'milestones'   => 'array',
        'is_active'    => 'boolean',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
