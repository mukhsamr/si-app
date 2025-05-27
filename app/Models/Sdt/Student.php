<?php

namespace App\Models\Sdt;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Student extends Model
{
    use HasFactory;

    protected $connection = 'sdt';
    const CREATED_AT = null;
    protected $guarded = [
        'id',
        'updated_at'
    ];
    protected function casts(): array
    {
        return [
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    function loans(): HasManyThrough
    {
        return $this->hasManyThrough(Loan::class, Device::class);
    }
}
