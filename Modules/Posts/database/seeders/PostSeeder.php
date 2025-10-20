<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Posts\Models\Post;
use Illuminate\Support\Str;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\Category\Models\Category;
use Nette\Utils\Random;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $total = 300000;
        // $chunk = 10000;

        // for($i = 0; $i<$total; $i+=$chunk)
        // {
        //     Post::factory()->count($chunk)->create();
        // }

        $data = [];
        $categories = Category::all();
        // $imageName = Str::random(20) . '.jpg';
        // $imagePath = public_path('storage/posts/' . $imageName);

        for ($i = 0; $i < 1000000; $i++) {
            $imageName = Str::random(20) . '.jpg';
            $imagePath = '/storage/posts/' . $imageName;

            $data[] = [
                'title' => Str::random(10),
                'content' => Str::random(50),
                'category_id' => $categories->random()->id,
                'image' => $imagePath, // relative path, not absolute
                'status' => Arr::random(['published', 'draft']),
                'created_at' => now()->format('Y-m-d H:i:s'), // formatted string
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ];
        }

        foreach (array_chunk($data, 1000) as $chunk) {
            DB::table('posts')->insert($chunk);
        }
    }
}
