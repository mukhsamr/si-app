<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $semester = File::get(storage_path('database/semesters.sql'));
        DB::unprepared($semester);
    }
}
