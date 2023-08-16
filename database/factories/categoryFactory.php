<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class categoryFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name'=> $this->faker->name,
            'slug'=> $this->faker->slug,
        ];
    }
}
