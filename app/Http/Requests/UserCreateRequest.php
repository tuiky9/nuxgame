<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[A-Za-z0-9._-]+$/',
                'unique:users,username',
            ],
            'phonenumber' => [
                'required',
                'string',
                'max:32',
                'regex:/^\+?[0-9\s\-\(\)]+$/',
                'unique:users,phonenumber',
            ],
        ];
    }
}
