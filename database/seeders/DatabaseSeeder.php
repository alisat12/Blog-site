<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\Category\Database\Seeders\CategorySeeder;
use Modules\Posts\Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategorySeeder::class,
            PostSeeder::class
        ]);
    }
}
