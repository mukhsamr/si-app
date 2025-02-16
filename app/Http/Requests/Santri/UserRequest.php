<?php

namespace App\Http\Requests\Santri;

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
            'username' => 'required|unique:App\Models\Santri\User,username,' . $this->user?->id,
            'password' => 'sometimes|required|min:8',
        ];
    }
}
