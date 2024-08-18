<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_hotel' => Hotel::factory(),
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
