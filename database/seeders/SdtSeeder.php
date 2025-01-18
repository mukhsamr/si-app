<?php

namespace Database\Seeders;

use App\Models\Sdt\Device;
use App\Models\Sdt\Loan;
use App\Models\Sdt\Rak;
use App\Models\Sdt\Student;
use App\Models\Sdt\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SdtSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'username' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'Amrullah',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'Aisyah',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'remember_token' => Str::random(10),
            ]
        ]);

        Rak::factory(6)->create();
        Student::factory(20)
            ->hasDevices(2)
            ->create();

        $loans = [];
        for ($i = 1; $i <= 7; $i++) {
            foreach (Device::all() as $device) {
                $loans[] = [
                    'created_at' => Carbon::parse('2025-01-01 09:00:00')->addDays($i),
                    'updated_at' => Carbon::parse('2025-01-01 09:00:00')->addDays($i)->addHours(rand(0, 4))->addMinutes(rand(0, 59)),
                    'device_id' => $device->id,
                    'user_id' => User::all()->random()->id,
                    'is_returned' => 1,
                ];
            }
        }

        Loan::insert($loans);
    }
}
