<?php

namespace App\Http\Resources\Sdt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'role' => $this->role,
            'updated_at' => $this->updated_at,
        ];

        if (isset($this->loans_count)) {
            $data['loans_count'] = $this->loans_count;
        }

        return $data;
    }
}
