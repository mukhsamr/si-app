<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $connection = 'sbt';

    function scopeSchoolType($query)
    {
        return $query->where('type', 'school');
    }

    function scopeBoardingType($query)
    {
        return $query->where('type', 'boarding');
    }
}
