<?php

namespace App\Http\Resources\Sbt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'kk' => $this->kk,
            'father_name' => $this->father_name,
            'father_job' => $this->father_job,
            'mother_name' => $this->mother_name,
            'mother_job' => $this->mother_job,
            'children' => $this->children,
            'address' => $this->address,
        ];
    }
}
