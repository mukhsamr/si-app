<?php

namespace App\Http\Resources\Sbt;

use App\Enums\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'unit' => Unit::from($this->unit),
            'type' => $this->type,
            'summary' => $this->summary,
            'note' => $this->note,
            'file' => $this->file,
            'student' => [
                'id' => $this->student->id,
                'name' => $this->student->name,
                'nickname' => $this->student->nickname,
                'photo' => $this->student->photo,
            ],
            'updated_at' => $this->updated_at->format('d M Y H:i:s'),
        ];
    }
}
