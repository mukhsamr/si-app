<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $connection = 'sbt';
}
