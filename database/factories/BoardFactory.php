<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "user_id" => User::factory(),
            // "user_id" => $this->faker->randomElement(User::pluck("id")->toArray()),
            "user_id" => User::all()->pluck('id')->random(),
            "title" => $this->faker->realText("20"),
            // "title" => $this->faker->unique()->sentence(),
            "content" => $this->faker->realText(),
            "created_at" => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
