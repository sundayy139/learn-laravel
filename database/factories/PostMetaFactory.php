<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post_meta>
 */
class PostMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "postId" => Post::query()->inRandomOrder()->value('id'),
            "key" => $this->faker->uuid,
            "content" => $this->faker->text,
        ];
    }
}
