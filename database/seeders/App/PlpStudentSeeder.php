<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PlpStudentSeeder extends Seeder
{
    public function run(): void
    {
        $file = File::get(storage_path('database/plp-student.sql'));
        DB::unprepared($file);
    }
}
