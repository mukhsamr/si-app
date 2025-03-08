<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $connection = 'app';
    public $timestamps = false;
    protected $guarded = ['id'];

    function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }
}
