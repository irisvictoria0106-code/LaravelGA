<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{

    User::firstOrCreate(
        ['email' => 'admin@grupoaguila.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('Admin123!'),
        ]
    );


    User::factory()->count(10)->create();

    $this->call([
  //      UserSeeder::class,
        ProductoSeeder::class,
    ]);
}
}
