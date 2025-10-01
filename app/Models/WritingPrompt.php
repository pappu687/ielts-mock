<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WritingPrompt extends Model
{
    use HasFactory;

    protected $table = 'writing_prompts';

    protected $fillable = [
        'task_type',
        'prompt_text',
        'image_file',
        'minimum_words',
        'time_limit',
        'assessment_criteria',
        'sample_responses',
        'difficulty_level',
     ];

    protected $casts = [
        'assessment_criteria' => 'array',
        'sample_responses'    => 'array',
     ];
}
