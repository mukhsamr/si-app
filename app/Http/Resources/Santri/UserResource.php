<?php

namespace App\Http\Resources\Santri;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'nis' => $this->profile->nis,
            'name' => $this->profile->name,
            'nickname' => $this->profile->nickname,
            'photo' => $this->profile->photo,
        ];
    }
}
