<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@grupoaguila.com',
                'password' => Hash::make('Admin123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Empleado',
                'email' => 'empleado@grupoaguila.com',
                'password' => Hash::make('Empleado123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@grupoaguila.com',
                'password' => Hash::make('Supervisor123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}