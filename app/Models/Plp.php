<?php

namespace App\Models;

use App\Enums\Plp as EnumsPlp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Plp extends Model
{
    protected $connection = 'app';
    public $timestamps = false;
    protected $guarded = ['id'];


    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn($value) => EnumsPlp::from($value)
        );
    }

    function scopeWhereActiveSemester(Builder $query)
    {
        return $query->where('semester_id', Semester::active()->first()->id);
    }
}
