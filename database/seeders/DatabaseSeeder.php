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
<<<<<<< HEAD
        
        $this->call([
            BookshelfSeeder::class,
            BookSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
>>>>>>> 91b5aee3c87cbb6316ed269da00321fec7ee8dc2
        ]);
    }
}
