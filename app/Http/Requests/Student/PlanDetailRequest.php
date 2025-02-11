<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class PlanDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:timeline,stepline,mayor_agenda,minor_routine',
            'content' => 'required',
        ];
    }
}
