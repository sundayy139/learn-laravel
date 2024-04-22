<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            "title" =>  $title,
            "metaTitle" => $this->faker->text(100),
            "slug" => $slug,
            "content" => $this->faker->text,
        ];
    }
}
