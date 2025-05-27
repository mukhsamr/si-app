<?php

namespace App\Http\Requests\Sdt;

use App\Models\Sdt\Device;
use App\Models\Sdt\Student;
use App\Models\Sdt\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_uid' => [
                'required',
                Rule::exists(Student::class, 'uid'),
            ],
            'device_uid' => [
                'required',
                Rule::exists(Device::class, 'uid')
            ],
            'user_id' => [
                'required',
                'sometimes',
                Rule::exists(User::class, 'id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'exists'   => ':attribute tidak ditemukan',
        ];
    }

    public function attributes(): array
    {
        return [
            'student_uid'   => 'Siswa',
            'device_uid'    => 'Device',
            'user_id'   => 'User',
        ];
    }
}
