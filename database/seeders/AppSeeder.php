<?php

namespace Database\Seeders;

use Database\Seeders\App\FamilySeeder;
use Database\Seeders\App\GradeSeeder;
use Database\Seeders\App\GradeStudentSeeder;
use Database\Seeders\App\PlpSeeder;
use Database\Seeders\App\PlpStudentSeeder;
use Database\Seeders\App\SemesterSeeder;
use Database\Seeders\App\StudentSeeder;
use Database\Seeders\App\UserSeeder;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SemesterSeeder::class,
            GradeSeeder::class,
            PlpSeeder::class,
            FamilySeeder::class,
            StudentSeeder::class,
            GradeStudentSeeder::class,
            PlpStudentSeeder::class
        ]);
    }
}
