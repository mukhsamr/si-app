<?php

namespace Database\Seeders\App;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'username' => 'Admin',
                'password' => Hash::make('password'),
            ]
        ]);
    }
}
