<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole(['admin', 'super-admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question_type_new' => 'required|string|in:mcq,fill_blank,matching,essay,speaking_topic,true_false,summary_completion,multiple_choice,map_labeling,note_completion,table_completion,flow_chart,diagram_labeling,sentence_completion',
            'question_text' => 'required|string',
            'content' => 'nullable|array',
            'options' => 'nullable|array',
            'correct_answers' => 'nullable|array',
            'explanation' => 'nullable|string',
            'hint' => 'nullable|string',
            'points' => 'nullable|integer|min:1|max:10',
            'difficulty_level' => 'nullable|string|in:easy,medium,hard',
            'estimated_time' => 'nullable|integer|min:10|max:300',
            'audio_segments' => 'nullable|array',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'question_type_new' => 'question type',
            'question_text' => 'question text',
            'correct_answers' => 'correct answers',
            'difficulty_level' => 'difficulty level',
            'estimated_time' => 'estimated time',
            'audio_segments' => 'audio segments',
        ];
    }
}
