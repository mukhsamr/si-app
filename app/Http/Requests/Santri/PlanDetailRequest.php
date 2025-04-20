<?php

namespace App\Http\Requests\Santri;

use App\Enums\Plan;
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
            'type' => 'required|in:' . implode(',', Plan::values()),
            'content' => 'required',
        ];
    }
}
