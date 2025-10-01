<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolesRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $roleId = $this->route('role')?->id ?? null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($roleId),
            ],
            'permission' => ['array'],
            'permission.*' => ['string', 'exists:permissions,name'],
        ];
    }
}


