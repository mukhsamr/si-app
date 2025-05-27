<?php

namespace App\Http\Resources\Sdt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'uid' => $this->uid,
            'type' => $this->type,
            'rak' => $this->whenLoaded('rak', fn() => RakResource::make($this->rak)),
            'student' => $this->whenLoaded('student', fn() => StudentResource::make($this->student)),
        ];
    }
}
