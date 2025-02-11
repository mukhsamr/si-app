<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $file = File::get(storage_path('database/student/users.sql'));
        DB::unprepared($file);

        $file = File::get(storage_path('database/student/profiles.sql'));
        DB::unprepared($file);
    }
}
