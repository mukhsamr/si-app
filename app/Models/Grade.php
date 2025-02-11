<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $connection = 'app';
    public $timestamps = false;
    protected $guarded = ['id'];
}
