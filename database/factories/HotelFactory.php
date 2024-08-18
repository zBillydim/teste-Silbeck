<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'fantasy_name' => $this->faker->companySuffix() . ' Hotel',
            'cnpj' => $this->formatCnpj($this->faker->unique()->numerify('########0001##')),
            'phone' => $this->faker->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Format CNPJ to the desired pattern.
     *
     * @param  string  $cnpj
     * @return string
     */
    private function formatCnpj(string $cnpj): string
    {
        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }
}
