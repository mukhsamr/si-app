<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $connection = 'sbt';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn($type) => $type ? 'p' : 'n',
        );
    }
}
