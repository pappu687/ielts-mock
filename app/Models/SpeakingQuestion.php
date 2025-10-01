<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakingQuestion extends Model
{
    use HasFactory;

    protected $table = 'speaking_questions';

    protected $fillable = [
        'part_number',
        'question_text',
        'follow_up_questions',
        'topic_category',
        'difficulty_level',
        'time_limit',
        'assessment_criteria',
        'sample_responses',
     ];

    protected $casts = [
        'follow_up_questions' => 'array',
        'assessment_criteria' => 'array',
        'sample_responses'    => 'array',
     ];
}
