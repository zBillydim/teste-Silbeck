<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomReservation>
 */
class RoomReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkin = $this->faker->dateTimeBetween('-1 month', 'now');
        $checkout = $this->faker->optional()->dateTimeBetween($checkin, '+1 week');

        return [
            'id_room' => Room::factory(),
            'id_user' => User::factory(),
            'id_hotel' => Hotel::factory(),
            'checkin' => $checkin,
            'checkout' => $checkout,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'total_price' => $checkout ? $this->faker->randomFloat(2, 100, 1000) : null,
            'unit_price' => $this->faker->randomFloat(2, 100, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
