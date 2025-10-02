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
        // Create admin user
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);

        // Run our comprehensive test seeders
        $this->call([
            TestSeeder::class,
            TestSectionSeeder::class,
            TestResourceSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
