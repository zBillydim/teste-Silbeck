<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomReservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Hotel::factory(10)->create();
        RoomReservation::factory(10)->create();
        Room::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'id_hotel' => 1,
                'password' => Hash::make('password123'),
                'phone' => '(11) 1234-5678',
                'cellphone' => '(11) 91234-5678',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'address' => 'Rua Exemplo, 123, São Paulo, SP',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guest User',
                'email' => 'guest@example.com',
                'id_hotel' => 1,
                'password' => Hash::make('password123'),
                'phone' => null,
                'cellphone' => '(21) 91234-5678',
                'cpf' => '987.654.321-00',
                'rg' => '98.765.432-1',
                'address' => 'Rua Exemplo, 456, Rio de Janeiro, RJ',
                'role' => 'guest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Master User',
                'email' => 'Master@example.com',
                'id_hotel' => null,
                'password' => Hash::make('password123'),
                'phone' => '(11) 1234-5678',
                'cellphone' => '(11) 91234-5678',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'address' => 'Rua Exemplo, 123, São Paulo, SP',
                'role' => 'master',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Recepcionist User',
                'email' => 'Recepcionist@example.com',
                'id_hotel' => 1,
                'password' => Hash::make('password123'),
                'phone' => '(11) 1234-5678',
                'cellphone' => '(11) 91234-5678',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'address' => 'Rua Exemplo, 123, São Paulo, SP',
                'role' => 'receptionist',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
