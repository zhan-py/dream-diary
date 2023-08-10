<?php

namespace Database\Factories;

use App\Models\Dream;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'user_id' => $this->faker->numberBetween(1, 10),
          'dream_id' => $this->faker->numberBetween(1, 20),
          'content' => $this->faker->paragraph,
        ];
    }
}
