<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario admin (sin duplicados)
        User::firstOrCreate(
            ['email' => 'admin@hotmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('1234567890'),
                'role' => 'admin',
            ]
        );

        // Seed de estados de préstamos
        $this->call(LoanStatusSeeder::class);

        // Seed de tipos de documento
        $this->call([DocumentTypeSeeder::class]);
    }
}
