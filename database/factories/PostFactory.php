<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'excerpt' => $this->faker->sentence,
            'category_id' => \App\Models\Category::factory(),
            'body' => $this->faker->text,
            'user_id' => \App\Models\User::factory(),
            'slug' => $this->faker->slug,
            'image' => $this->faker->image('public/storage/images',640,480, null, false),

        ];
    }
}
