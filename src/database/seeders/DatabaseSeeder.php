<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $dataUser = [
            'name' => 'Test User',
            'password' => bcrypt('password')
        ];

        User::updateOrCreate([
            'email' => 'admin@tj.rj.gov.br'
        ],$dataUser);

        
        $this->call([
            AutorSeeder::class,
            AssuntoSeeder::class,
            LivroSeeder::class,
        ]);
    }
}
