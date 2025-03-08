<?php

namespace App\Http\Requests\Sbt;

use App\Enums\Unit;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:App\Models\Sbt\Student,id',
            'title' => 'required',
            'unit' => 'required|in:' . implode(',', Unit::values()),
            'note' => 'required',
            'type' => 'required|boolean',
            'file' => 'file',
        ];
    }
}
