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
            "id" => $this->faker->unixTime,
            "firstName" => $this->faker->firstName,
            "middleName" => $this->faker->suffix,
            "lastName" => $this->faker->lastName,
            "mobile" => $this->faker->e164PhoneNumber,
            "email" => $this->faker->email,
            "passwordHash" => $this->faker->password,
            "registedAt" => $this->faker->dateTime,
            "lastLogin" => $this->faker->dateTime,
            "intro" =>  $this->faker->boolean() ? $this->faker->paragraph(3, true) : null,
            "profile" => $this->faker->boolean() ? $this->faker->text : null,
        ];
    }
}
