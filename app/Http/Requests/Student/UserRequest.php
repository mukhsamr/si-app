<?php

namespace App\Http\Requests\Student;

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
            'username' => 'required|unique:App\Models\Student\User,username,' . $this->user?->id,
            'password' => 'sometimes|required|min:8',
        ];
    }
}
