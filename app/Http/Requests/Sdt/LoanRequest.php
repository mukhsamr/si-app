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
            'student_id' => 'required|exists:App\Models\Sdt\Student,id',
            'device_id' => 'required|exists:App\Models\Sdt\Device,id',
            'user_id' => 'required|exists:App\Models\Sdt\User,id',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Siswa wajib diisi',
            'student_id.exists' => 'Siswa tidak ditemukan',
            'device_id.required' => 'Device wajib diisi',
            'device_id.exists' => 'Device tidak ditemukan',
            'user_id.required' => 'User wajib diisi',
            'user_id.exists' => 'User tidak ditemukan',
        ];
    }
}
