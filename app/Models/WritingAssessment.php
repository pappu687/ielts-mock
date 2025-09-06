<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WritingAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_section_id',
        'response_text',
        'word_count',
        'task_achievement_score',
        'coherence_cohesion_score',
        'lexical_resource_score',
        'grammar_accuracy_score',
        'overall_band_score',
        'detailed_feedback',
        'assessor_type',
        'assessed_at',
     ];

    protected $casts = [
        'detailed_feedback'        => 'array',
        'task_achievement_score'   => 'float',
        'coherence_cohesion_score' => 'float',
        'lexical_resource_score'   => 'float',
        'grammar_accuracy_score'   => 'float',
        'overall_band_score'       => 'float',
        'assessed_at'              => 'datetime',
     ];

    public function examSection(): BelongsTo
    {
        return $this->belongsTo(ExamSection::class);
    }
}
