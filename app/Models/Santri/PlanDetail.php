<?php

namespace App\Models\Santri;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $connection = 'santri';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
