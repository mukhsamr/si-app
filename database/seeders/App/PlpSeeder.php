<?php

namespace Database\Seeders\App;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PlpSeeder extends Seeder
{
    public function run(): void
    {
        $plps = File::get(storage_path('database/plps.sql'));
        DB::unprepared($plps);
    }
}
