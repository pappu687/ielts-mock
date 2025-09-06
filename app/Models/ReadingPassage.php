<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingPassage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'difficulty_level',
        'word_count',
        'source',
        'topic_category',
        'question_types',
        'estimated_reading_time',
        'academic_or_general',
     ];

    protected $casts = [
        'question_types' => 'array',
     ];
}
