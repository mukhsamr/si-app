<?php

namespace Database\Factories\Sbt;

use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kk' => fake()->unique()->ean13(),
            'father_name' => fake()->name('male'),
            'father_job' => fake()->jobTitle(),
            'mother_name' => fake()->name('female'),
            'mother_job' => fake()->jobTitle(),
            'children' => fake()->numberBetween(1, 5),
            'address' => fake()->address(),
        ];
    }
}
