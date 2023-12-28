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
            $category->post()->saveMany(Post::factory(10)->create([
                'type' => 'blog',
                'category_id' => $category->id
            ])->each(function (Post $post) use ($category) {
                $post->children()->saveMany(Post::factory(mt_rand(1,3))->create([
                    'type' => 'blog',
                    'category_id' => $category->id,
                ]));
//                generate comment
                $post->comments()->saveMany(Comment::factory(3)->make()->each(function (Comment $comment) {
//                    generate comment children
                    $comment->children()->saveMany(Comment::factory(2)->make());
                }));

            }));

        });
    }

}
