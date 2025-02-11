<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'username' => 'Admin',
                'password' => Hash::make('password'),
            ]
        ]);

        $file = File::get(storage_path('database/students.sql'));
        DB::unprepared($file);
    }
}
