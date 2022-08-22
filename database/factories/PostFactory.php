<?php

namespace Database\Factories;

use App\Models\AdminMoldels\Category;
use App\Models\AdminMoldels\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "Title" => fake()->title(),
            "Content" => fake()->paragraph() ,
            "category_id" => Category::factory(),
            "user_id" => User::factory()
        ];
    }
}
