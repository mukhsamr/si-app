<?php

namespace App\Http\Requests\Sdt;

use App\Models\Sdt\Device;
use App\Models\Sdt\Rak;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class DeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required'
            ],
            'uid' => [
                'required',
                Rule::unique(Device::class, 'uid')->ignore($this->device),
            ],
            'type' => [
                'required',
                Rule::in([0, 1, 2])
            ],
            'rak_id' => [
                'required',
                Rule::exists(Rak::class, 'id'),
            ],
        ];
    }

    public function after(): array
    {
        $device = Device::firstWhere('uid', $this->input('uid'));
        if ($device === null) {
            return [];
        }

        return [
            function (Validator $validator) use ($device) {
                $student = $device->student;

                if ($student->devices()->where('type', $this->input('type'))->exists()) {
                    $validator->errors()->add('type', 'Siswa sudah memiliki device dengan tipe yang sama.');
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique'   => ':attribute telah digunakan',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'   => 'Nama',
            'uid'    => 'UID',
            'type'   => 'Tipe',
            'rak_id' => 'Rak',
        ];
    }
}
