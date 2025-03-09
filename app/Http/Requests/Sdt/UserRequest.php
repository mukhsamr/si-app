<?php

namespace App\Http\Requests\Sdt;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|unique:App\Models\Sdt\User,username,' . $this->user?->id,
            'password' => 'sometimes|required|min:8',
            'role' => 'sometimes|required|in:admin,operator,student',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari 8 karakter atau lebih.',
            'role.required' => 'Role wajib diisi.',
            'role.in' => 'Role tidak valid.',
        ];
    }
}
