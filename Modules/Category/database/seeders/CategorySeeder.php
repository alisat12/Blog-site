<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()->count(50)->create();

        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $name = Str::random(10);
            $data[] = [
                'name' => $name,
                'slug' => Str::slug($name)
            ];
        }

        DB::table('categories')->insert($data);
    }
}
