<?php

namespace Database\Factories\Sbt;

use App\Models\Sbt\Family;
use App\Models\Sbt\Student;
use App\Models\Sbt\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $gender = rand(0, 1);
        return [
            'user_id' => User::factory(),
            'family_id' => Family::factory(),
            'nik' => fake()->unique()->nik(),
            'nis' => fake()->unique()->ean13(),
            'name' => fake()->name($gender ? 'male' : 'female'),
            'nickname' => fake()->name($gender ? 'male' : 'female'),
            'gender' => rand(0, 1),
            'birth_date' => fake()->date(),
            'birth_place' => fake()->city(),
            'birth_order' => fake()->numberBetween(1, 5),
            'school' => fake()->company(),
            'height' => fake()->numberBetween(100, 200),
            'weight' => fake()->numberBetween(30, 100),
            'photo' => null,
            'is_active' => rand(0, 1),
            'is_graduate' => rand(0, 1),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Student $student) {
            $student->grades()->attach([
                rand(1, 6) => ['semester_id' => 1],
                rand(7, 12) => ['semester_id' => 1]
            ]);

            $student->plps()->attach([
                rand(1, 3) => ['semester_id' => 1],
                rand(4, 6) => ['semester_id' => 1],
            ]);
        });
    }
}
