<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = File::get(storage_path('database/grades.sql'));
        DB::unprepared($grades);
    }
}
