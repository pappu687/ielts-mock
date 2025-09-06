<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_session_id',
        'section_type',
        'status',
        'start_time',
        'end_time',
        'time_limit',
        'responses',
        'raw_score',
        'band_score',
        'feedback',
     ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
        'responses'  => 'array',
        'feedback'   => 'array',
        'raw_score'  => 'float',
        'band_score' => 'float',
     ];

    public function examSession(): BelongsTo
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function writingAssessments(): HasMany
    {
        return $this->hasMany(WritingAssessment::class);
    }

    public function speakingAssessments(): HasMany
    {
        return $this->hasMany(SpeakingAssessment::class);
    }
}
