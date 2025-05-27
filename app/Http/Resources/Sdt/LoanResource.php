<?php

namespace App\Http\Resources\Sdt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'device' => $this->whenLoaded('device', fn() => DeviceResource::make($this->device)),
            'student' => $this->whenLoaded('student', fn() => StudentResource::make($this->student)),
            'time_diff' => $this->time_diff,
            'start_hour' => $this->start_hour,
            'end_hour' => $this->end_hour,
            'is_returned' => $this->is_returned,
            'operator' => $this->operator,
            'date' => $this->date,
        ];
    }
}
