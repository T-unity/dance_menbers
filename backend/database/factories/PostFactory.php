<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'user_id' => rand(1, 99),
        'title' => $this->faker->text(),
        'content' => $this->faker->text(),
      ];
    }
}
