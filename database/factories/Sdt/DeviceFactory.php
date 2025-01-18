<?php

namespace Database\Factories\Sdt;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sdt\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'uid' => fake()->unique()->ean13(),
            'type' => fake()->boolean(),
            'rak_id' => fake()->numberBetween(1, 6),
        ];
    }
}
