<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Model;

class PlpStudent extends Model
{
    protected $table = 'plp_student';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $connection = 'sbt';
}
