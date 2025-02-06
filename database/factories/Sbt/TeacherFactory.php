<?php

namespace Database\Factories\Sbt;

use App\Models\Sbt\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nik' => fake()->unique()->nik(),
            'name' => fake()->name(),
            'birth_date' => fake()->date(),
        ];
    }
}
