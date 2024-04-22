<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->text(75);
        $slug = Str::slug($title);
        return [
            "authorId" => User::query()->inRandomOrder()->value('id'),
            "title" => $title,
            "metaTitle" => $this->faker->text(100),
            "slug" =>  $slug,
            "sumary" => $this->faker->text(25),
            "published" => $this->faker->boolean() ?  0 : 1,
            "createdAt" => $this->faker->dateTime,
            "updatedAt" => $this->faker->dateTime,
            "publishedAt" => $this->faker->dateTime,
            "content" => $this->faker->text,
        ];
    }
}
