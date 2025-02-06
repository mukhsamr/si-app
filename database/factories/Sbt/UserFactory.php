<?php

namespace Database\Factories\Sbt;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->username(),
            'password' => 'password',
        ];
    }
}
