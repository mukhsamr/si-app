<?php

namespace App\Http\Resources;

use App\Http\Resources\Sbt\FamilyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentFamilyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'nis' => $this->nis,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'birth_order' => $this->birth_order,
            'school' => $this->school,
            'height' => $this->height,
            'weight' => $this->weight,
            'photo' => $this->photo,
            'is_active' => $this->is_active,
            'is_graduate' => $this->is_graduate,
            'family' => FamilyResource::make($this->family),
        ];
    }
}
