<?php

namespace App\Http\Requests\Sdt;

use App\Models\Sdt\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
                Rule::unique(User::class, 'username')->ignore($this->user),
            ],
            'password' => [
                'sometimes',
                'required',
                'min:8'
            ],
            'role' => [
                'sometimes',
                'required',
                Rule::in(['admin', 'operator', 'student'])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute telah digunakan',
            'min' => ':attribute harus terdiri dari 8 karakter atau lebih',
            'in' => ':attribute tidak valid',
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }
}
