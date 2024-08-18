<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'id_hotel' => $this->faker->numberBetween(1, 10),
            'phone' => $this->faker->optional()->phoneNumber(),
            'cellphone' => $this->faker->phoneNumber(),
            'cpf' => $this->formatCpf($this->faker->unique()->numerify('###########')),
            'rg' => $this->formatRg($this->faker->unique()->numerify('########')),
            'address' => $this->faker->address(),
            'role' => $this->faker->randomElement(['guest', 'receptionist', 'admin', 'master']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Format CPF to the desired pattern.
     *
     * @param  string  $cpf
     * @return string
     */
    private function formatCpf(string $cpf): string
    {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    /**
     * Format RG to the desired pattern.
     *
     * @param  string  $rg
     * @return string
     */
    private function formatRg(string $rg): string
    {
        return substr($rg, 0, 2) . '.' . substr($rg, 2, 3) . '.' . substr($rg, 5, 3) . '-' . substr($rg, 8, 1);
    }
}
