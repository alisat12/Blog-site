<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Database\Seeders\CategorySeeder;

class PostsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([PostSeeder::class]);
        $this->call(CategorySeeder::class);
    }
}
