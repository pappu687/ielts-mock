<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_section_id',
        'question_id',
        'user_response',
        'time_spent',
        'is_correct',
        'partial_score',
        'ai_feedback',
        'human_feedback',
     ];

    protected $casts = [
        'user_response'  => 'array',
        'ai_feedback'    => 'array',
        'human_feedback' => 'array',
        'is_correct'     => 'boolean',
        'partial_score'  => 'float',
     ];

    public function examSection(): BelongsTo
    {
        return $this->belongsTo(ExamSection::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
