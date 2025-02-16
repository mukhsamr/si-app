<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        $file = File::get(storage_path('database/santri/users.sql'));
        DB::unprepared($file);

        $file = File::get(storage_path('database/santri/profiles.sql'));
        DB::unprepared($file);
    }
}
