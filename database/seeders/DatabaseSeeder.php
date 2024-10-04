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
        $this->call('Database\Seeders\LabelSeeder');
        $this->call('Database\Seeders\StatusSeeder');
        
        
        /*// User::factory(10)->create();

=======
        // User::factory(10)->create();
/*
>>>>>>> main
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
