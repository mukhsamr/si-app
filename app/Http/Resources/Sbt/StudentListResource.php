<?php

namespace App\Http\Resources\Sbt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'age' => $this->age
        ];
    }
}
