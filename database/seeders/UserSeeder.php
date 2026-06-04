<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@grupoaguila.com',
            'password' => bcrypt('Admin123!'),
        ]);
        
        User::create([
            'name' => 'Empleado',
            'email' => 'empleado@grupoaguila.com',
            'password' => bcrypt('Empleado123!'),
        ]);
        
        $this->command->info('Usuarios creados:');
        $this->command->info('   admin@grupoaguila.com / Admin123!');
        $this->command->info('   empleado@grupoaguila.com / Empleado123!');
    }
}