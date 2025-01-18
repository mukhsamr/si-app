<?php

namespace App\Http\Requests\Sdt;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'device_id' => 'required|exists:App\Models\Sdt\Device,id',
            'user_id' => 'required|exists:App\Models\Sdt\User,id',
        ];
    }
}
