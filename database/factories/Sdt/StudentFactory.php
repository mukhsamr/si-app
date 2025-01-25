<?php

namespace Database\Factories\Sdt;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sdt\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->boolean();
        return [
            'name' => fake()->name($gender ? 'male' : 'female'),
            'nik' => fake()->unique()->nik(),
            'uid' => fake()->unique()->ean13(),
            'campus' => $gender,
        ];
    }
}
