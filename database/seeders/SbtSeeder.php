<?php

namespace Database\Seeders;

use App\Models\Sbt\Family;
use App\Models\Sbt\Grade;
use App\Models\Sbt\Plp;
use App\Models\Sbt\Semester;
use App\Models\Sbt\Student;
use App\Models\Sbt\Teacher;
use App\Models\Sbt\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SbtSeeder extends Seeder
{
    public function run(): void
    {
        Semester::insert([
            [
                'semester' => '1',
                'period' => '2024/2025',
                'is_active' => true
            ],
            [
                'semester' => '2',
                'period' => '2024/2025',
                'is_active' => false
            ],
        ]);
        Grade::insert([
            [
                'grade' => '1',
                'type' => 'boarding'
            ],
            [
                'grade' => '2',
                'type' => 'boarding'
            ],
            [
                'grade' => '3',
                'type' => 'boarding'
            ],
            [
                'grade' => '4',
                'type' => 'boarding'
            ],
            [
                'grade' => '5',
                'type' => 'boarding'
            ],
            [
                'grade' => '6',
                'type' => 'boarding'
            ],
            [
                'grade' => '1',
                'type' => 'school'
            ],
            [
                'grade' => '2',
                'type' => 'school'
            ],
            [
                'grade' => '3',
                'type' => 'school'
            ],
            [
                'grade' => '4',
                'type' => 'school'
            ],
            [
                'grade' => '5',
                'type' => 'school'
            ],
            [
                'grade' => '6',
                'type' => 'school'
            ]
        ]);
        Plp::factory(6)->create();

        $families = Family::factory()
            ->count(10)
            ->create();

        User::factory(10)
            ->hasTeacher()
            ->create();

        User::factory(10)
            ->has(
                Student::factory()
                    ->count(1)
                    ->recycle($families)
            )->create();
    }
}
