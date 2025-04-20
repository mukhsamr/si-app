<?php

namespace App\Http\Resources\Santri;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'pdf' => $this->pdf,
            'is_editable' => $this->is_editable,
            'created_at' => $this->created_at->format('d M Y H:i:s'),
            'plan_details' => PlanDetailResource::collection($this->planDetails),
        ];
    }
}
