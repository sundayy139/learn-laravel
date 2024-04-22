<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "firstName" => $this->faker->firstName,
            "middleName" => $this->faker->suffix,
            "lastName" => $this->faker->lastName,
            "mobile" => $this->faker->e164PhoneNumber,
            "email" => $this->faker->email,
            "password" => $this->faker->password,
            "registedAt" => $this->faker->dateTime,
            "lastLogin" => $this->faker->dateTime,
            "intro" =>  $this->faker->boolean() ? $this->faker->text : null,
            "profile" => $this->faker->boolean() ? $this->faker->text : null,
        ];
    }
}
