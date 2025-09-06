<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_type_id',
        'status',
        'started_at',
        'completed_at',
        'time_remaining',
        'current_section',
        'session_data',
        'overall_band_score',
        'detailed_scores',
     ];

    protected $casts = [
        'started_at'         => 'datetime',
        'completed_at'       => 'datetime',
        'session_data'       => 'array',
        'detailed_scores'    => 'array',
        'overall_band_score' => 'float',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function examType(): BelongsTo
    {
        return $this->belongsTo(ExamType::class);
    }

    public function examSections(): HasMany
    {
        return $this->hasMany(ExamSection::class);
    }

    public function scoreHistory(): HasMany
    {
        return $this->hasMany(ScoreHistory::class);
    }
}
