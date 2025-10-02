<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:tests,name',
            'type' => 'required|in:listening,reading,writing,speaking',
            'description' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:1|max:300',
            'settings' => 'nullable|array',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'test name',
            'type' => 'test type',
            'duration_minutes' => 'duration',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The test name is required.',
            'name.unique' => 'A test with this name already exists.',
            'type.required' => 'Please select a test type.',
            'type.in' => 'The test type must be one of: listening, reading, writing, speaking.',
            'duration_minutes.integer' => 'Duration must be a valid number.',
            'duration_minutes.min' => 'Duration must be at least 1 minute.',
            'duration_minutes.max' => 'Duration cannot exceed 300 minutes.',
        ];
    }
}
