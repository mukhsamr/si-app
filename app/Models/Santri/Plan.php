<?php

namespace App\Models\Santri;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
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

    protected function pdf(): Attribute
    {
        $imagesPath = '/storage/students/plan';
        return Attribute::make(
            get: fn($pdf) => $pdf ? url("{$imagesPath}/{$pdf}") : '',
        );
    }

    function planDetails(): HasMany
    {
        return $this->hasMany(PlanDetail::class);
    }
}
