<?php

namespace Database\Seeders;

use App\Models\AdminMoldels\Category;
use App\Models\AdminMoldels\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //in this sedder ... we generate 100 user and each of these users has 100 post (all posts belongs to one category)
        $category = Category::factory()->create();
        User::factory()->count(100)->has(Post::factory()->count(100)->for($category))->create();
    }
}
