<?php

namespace App\Http\Resources\Sbt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentNoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit' => $this->unit,
            'title' => $this->title,
            'note' => $this->note,
            'type' => $this->type,
            'summary' => $this->summary,
            'file' => $this->file,
            'author' => $this->author,
            'updated_at' => $this->updated_at->format('d M Y H:i:s'),
        ];
    }
}
