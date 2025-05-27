<?php

namespace App\Http\Requests\Sdt;

use App\Models\Sdt\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                Rule::exists(Student::class, 'id'),
            ],
            'uid' => [
                'required',
                Rule::unique(Student::class, 'uid')->ignore($this->student),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute telah digunakan',
        ];
    }

    public function attributes(): array
    {
        return [
            'uid' => 'UID',
        ];
    }
}
