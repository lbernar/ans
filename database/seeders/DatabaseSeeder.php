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
        // Create admin user
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@ans.com',
            'password' => Hash::make('admin123'),
            'level' => User::LEVEL_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'register_date' => now()->format('d/m/Y H:i'),
        ]);

        // Create regular user
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'usuario@ans.com',
            'password' => Hash::make('user123'),
            'level' => User::LEVEL_USER,
            'status' => User::STATUS_ACTIVE,
            'blood_type' => 'O+',
            'register_date' => now()->format('d/m/Y H:i'),
        ]);
    }
}
