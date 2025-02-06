<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Model;

class GradeStudent extends Model
{
    protected $table = 'grade_student';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $connection = 'sbt';
}
