<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoreHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_session_id',
        'skill_type',
        'band_score',
        'sub_scores',
        'percentile_rank',
        'improvement_rate',
        'weak_areas',
        'strong_areas',
     ];

    protected $casts = [
        'sub_scores'       => 'array',
        'weak_areas'       => 'array',
        'strong_areas'     => 'array',
        'band_score'       => 'float',
        'improvement_rate' => 'float',
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function examSession(): BelongsTo
    {
        return $this->belongsTo(ExamSession::class);
    }
}
