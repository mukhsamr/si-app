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

        // Rak::factory(6)->create();
        // Student::factory(20)
        //     ->has(
        //         Device::factory()
        //             ->state(['type' => 1]),
        //         'devices'
        //     )
        //     ->has(
        //         Device::factory()
        //             ->state(['type' => 2]),
        //         'devices'
        //     )
        //     ->has(
        //         Device::factory()
        //             ->state(['type' => 3]),
        //         'devices'
        //     )
        //     ->create();

        // $date = Carbon::now()->subDays(7)->subHours(7)->format('Y-m-d H:i:s');
        // $loans = [];
        // for ($i = 1; $i <= 7; $i++) {
        //     foreach (Device::with('student')->get() as $device) {
        //         $is_returned = $i < 7 ? true : rand(0, 1);
        //         $loans[] = [
        //             'created_at' => Carbon::parse($date)->addDays($i)->addHours(rand(0, 3))->addMinutes(rand(0, 59)),
        //             'updated_at' => $is_returned ? Carbon::parse($date)->addDays($i)->addHours(rand(0, 4))->addMinutes(rand(0, 59)) : null,
        //             'device_id' => $device->id,
        //             'student_id' => $device->student->id,
        //             'user_id' => User::all()->random()->id,
        //             'is_returned' => $is_returned,
        //         ];
        //     }
        // }

        // Loan::insert($loans);
    }
}
