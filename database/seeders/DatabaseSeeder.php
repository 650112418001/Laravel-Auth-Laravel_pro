<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Province;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([AdminSeeder::class]);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '1234'
        ]);

        Province::create(['name' => 'โคราช']);
        Province::create(['name' => 'บุรีรัมย์']);
        Province::create(['name' => 'สุรินทร์']);
    }
}
