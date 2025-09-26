<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_bank_id',
        'question_type',
        'question_text',
        'content',
        'difficulty_level',
        'estimated_time',
        'metadata',
        'audio_file',
        'image_files',
        'correct_answers',
        'explanation',
        'tips',
        'skill_focus_areas',
     ];

    protected $casts = [
        'content'           => 'array',
        'metadata'          => 'array',
        'image_files'       => 'array',
        'correct_answers'   => 'array',
        'skill_focus_areas' => 'array',
     ];

    public function questionBank(): BelongsTo
    {
        return $this->belongsTo(QuestionBank::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}
