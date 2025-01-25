<?php

namespace App\Http\Requests\Sdt;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'uid' => 'required|unique:App\Models\Sdt\Device,uid,' . $this->device?->id,
            'type' => 'required|boolean',
            'rak_id' => 'required|exists:App\Models\Sdt\Rak,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'uid.required' => 'UID tidak boleh kosong',
            'uid.unique' => 'UID telah digunakan',
            'type.required' => 'Tipe tidak boleh kosong',
            'rak_id.required' => 'Rak tidak boleh kosong',
        ];
    }
}
