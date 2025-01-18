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
}
