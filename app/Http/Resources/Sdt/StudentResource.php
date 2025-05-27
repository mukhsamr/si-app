<?php

namespace App\Http\Resources\Sdt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'uid' => $this->uid,
            'name' => $this->name,
            'photo' => $this->photo,
            'devices' => $this->whenLoaded('devices', fn() => DeviceResource::collection($this->devices)),
        ];
    }
}
