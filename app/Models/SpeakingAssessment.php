<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeakingAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_section_id',
        'audio_file_path',
        'transcript',
        'fluency_coherence_score',
        'lexical_resource_score',
        'grammar_range_score',
        'pronunciation_score',
        'overall_band_score',
        'detailed_feedback',
        'assessor_type',
        'assessed_at',
     ];

    protected $casts = [
        'detailed_feedback'       => 'array',
        'fluency_coherence_score' => 'float',
        'lexical_resource_score'  => 'float',
        'grammar_range_score'     => 'float',
        'pronunciation_score'     => 'float',
        'overall_band_score'      => 'float',
        'assessed_at'             => 'datetime',
     ];

    public function examSection(): BelongsTo
    {
        return $this->belongsTo(ExamSection::class);
    }
}
