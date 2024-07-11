<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->sentence(),
            'body' => fake()->words(random_int(50, 150), true),
            'user_id' => auth()->id() ?? User::factory(),
            'slug' => Str::replace(' ', '-', Str::replace('.', '', strtolower($title))),
            'excerpt' => fake()->words(15, true),
        ];
    }
}
