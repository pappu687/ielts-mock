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
        'test_section_id',
        'question_type',
        'question_type_new',
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
        'order',
        'points',
        'options',
        'hint',
        'audio_segments',
     ];

    protected $casts = [
        'content'           => 'array',
        'metadata'          => 'array',
        'image_files'       => 'array',
        'correct_answers'   => 'array',
        'skill_focus_areas' => 'array',
        'options'           => 'array',
        'audio_segments'    => 'array',
     ];

    public function questionBank(): BelongsTo
    {
        return $this->belongsTo(QuestionBank::class);
    }

    public function testSection(): BelongsTo
    {
        return $this->belongsTo(TestSection::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function isMcq(): bool
    {
        return in_array($this->question_type_new ?? $this->question_type, ['mcq', 'multiple_choice']);
    }

    public function isFillBlank(): bool
    {
        return in_array($this->question_type_new ?? $this->question_type, ['fill_blank', 'sentence_completion']);
    }

    public function isMatching(): bool
    {
        return $this->question_type_new === 'matching';
    }

    public function isEssay(): bool
    {
        return in_array($this->question_type_new ?? $this->question_type, ['essay', 'speaking_topic']);
    }

    public function isTrueFalse(): bool
    {
        return $this->question_type_new === 'true_false';
    }

    public function isListening(): bool
    {
        return in_array($this->question_type_new ?? $this->question_type, [
            'note_completion', 'table_completion', 'flow_chart', 
            'diagram_labeling', 'map_labeling'
        ]);
    }

    // Scope for questions in a specific section
    public function scopeInSection($query, $sectionId)
    {
        return $query->where('test_section_id', $sectionId);
    }

    // Scope ordered by order field
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
