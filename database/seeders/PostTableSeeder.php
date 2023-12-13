<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::all()->each(function (Category $category) {
            $post = $category->post()->saveMany(Post::factory(10)->create([
                'type' => 'blog',
                'category_id' => $category->id
            ]));
        });

        $posts = Post::whereType('blog')->cursor();
        foreach ($posts as $post) {
            $post->comments()->saveMany(Comment::factory(3)->make());
        }
    }
}
