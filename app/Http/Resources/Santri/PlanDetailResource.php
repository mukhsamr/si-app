<?php

namespace App\Http\Resources\Santri;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'content' => $this->content,
            'updated_at' => $this->updated_at->format('d M Y H:i:s'),
        ];
    }
}
