<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(2,10),
            'image_id' => fake()->numberBetween(1,10),
            'status_id' => fake()->numberBetween(1,3),
            'title' => fake()->text(20), // password
            'description' => fake()->text(400),
            'published_at' => fake()->dateTimeBetween("-1 month", 'now')
        ];
    }
}
