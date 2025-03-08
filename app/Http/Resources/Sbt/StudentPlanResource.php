<?php

namespace App\Http\Resources\Sbt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'pdf' => $this->pdf,
            'updated_at' => $this->updated_at->format('d M Y H:i:s'),
        ];
    }
}
