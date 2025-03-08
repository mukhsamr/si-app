<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GradeStudentSeeder extends Seeder
{
    public function run(): void
    {
        $file = File::get(storage_path('database/grade-student.sql'));
        DB::unprepared($file);
    }
}
