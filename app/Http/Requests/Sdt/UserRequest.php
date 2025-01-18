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
            'role' => 'required|in:admin,operator,student',
        ];
    }
}
