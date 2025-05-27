<?php

namespace App\Http\Requests\Sdt;

use App\Models\Sdt\Rak;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(Rak::class, 'name')->ignore($this->rak),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama rak harus diisi.',
            'name.unique' => 'Nama rak sudah ada.',
        ];
    }
}
