<?php

namespace App\Http\Resources\Sbt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'grades' => [
                'pondok' => $this->currentGrades->where('type', 'pondok')->first()->grade,
                'payung' => $this->currentGrades->where('type', 'payung')->first()->grade
            ]
        ];
    }
}
