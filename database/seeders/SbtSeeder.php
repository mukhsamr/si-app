<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SbtSeeder extends Seeder
{
    public function run(): void
    {
        $file = File::get(storage_path('database/sbt/users.sql'));
        DB::unprepared($file);

        $file = File::get(storage_path('database/sbt/profiles.sql'));
        DB::unprepared($file);

        $file = File::get(storage_path('database/sbt/students.sql'));
        DB::unprepared($file);
    }
}
