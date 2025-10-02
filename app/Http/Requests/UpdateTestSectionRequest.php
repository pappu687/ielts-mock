<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'order' => 'required|integer|min:1',
            'time_limit_minutes' => 'nullable|integer|min:1|max:300',
            'instructions' => 'nullable|array',
            'instructions.*' => 'string|max:500',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'section name',
            'description' => 'section description',
            'order' => 'section order',
            'time_limit_minutes' => 'time limit',
            'instructions' => 'instructions',
            'is_active' => 'active status',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The section name is required.',
            'name.max' => 'The section name may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'order.required' => 'The section order is required.',
            'order.min' => 'The section order must be at least 1.',
            'time_limit_minutes.min' => 'The time limit must be at least 1 minute.',
            'time_limit_minutes.max' => 'The time limit may not be greater than 300 minutes.',
        ];
    }
}
