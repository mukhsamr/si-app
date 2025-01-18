<?php

namespace App\Http\Requests\Sdt;

use Illuminate\Foundation\Http\FormRequest;

class RakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:App\Models\Sdt\Rak,name,' . $this->rak?->id,
        ];
    }
}
