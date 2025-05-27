<?php

namespace App\Http\Resources\Sdt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RakResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'devices' => $this->whenLoaded('devices', fn() => DeviceResource::collection($this->devices)),
            'devices_count' => $this->when($this->devices_count, $this->devices_count),
        ];
    }
}
