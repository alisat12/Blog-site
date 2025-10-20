<?php

namespace Modules\Posts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Models\Category;
use Modules\Posts\Models\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence(),
            'content'=>$this->faker->paragraph(3, true),
            'category_id'=>Category::factory(),
            'image' => '/storage/posts/' . $this->faker->image('public/storage/posts', 640, 480, null, false),
            'status' =>$this->faker->randomElement(['Published', 'Draft'])
        ];
    }
}

