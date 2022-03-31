<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'post_id' => 1,
            'parent_id' => $this->faker->numberBetween(1, 30),
            'level' => $this->faker->numberBetween(1, 3),
            'username' => $this->faker->userName(),
            'content' => $this->faker->text(),
        ];
    }
}
