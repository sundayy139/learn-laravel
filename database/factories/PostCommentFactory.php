<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post_comment>
 */
class PostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "postId" =>  Post::query()->inRandomOrder()->value('id'),
            "title" => $this->faker->text(75),
            "published" =>  $this->faker->boolean() ?  0 : 1,
            "createdAt" => $this->faker->dateTime,
            "publishedAt" => $this->faker->dateTime,
            "content" => $this->faker->text,
        ];
    }
}
