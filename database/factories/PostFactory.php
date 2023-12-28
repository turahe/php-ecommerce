<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = collect($this->faker->paragraphs(mt_rand(3, 7), true))
            ->map(static function ($item) {
                return $item;
            })->toArray();

        $content = implode($content);
        return [
            'title' => $this->faker->sentence,
            'content_raw' => $content
        ];
    }
}
