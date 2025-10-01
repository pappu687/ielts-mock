<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolesRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permission' => ['array'],
            'permission.*' => ['string', 'exists:permissions,name'],
        ];
    }
}


