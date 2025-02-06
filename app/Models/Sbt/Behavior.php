<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $connection = 'sbt';
}
