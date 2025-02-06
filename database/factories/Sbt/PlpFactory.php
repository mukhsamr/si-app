<?php

namespace Database\Factories\Sbt;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlpFactory extends Factory
{
    public function definition(): array
    {
        return [
            'plp' => fake()->unique()->word(),
            'type' => fake()->randomElement(['tahfidz', 'it'])
        ];
    }
}
