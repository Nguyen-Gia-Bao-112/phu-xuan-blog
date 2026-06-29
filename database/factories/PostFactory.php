<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(4, 8));

        return [
            'title'        => rtrim($title, '.'),
            'slug'         => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 99999),
            'content'      => implode("\n\n", $this->faker->paragraphs(rand(3, 6))),
            'excerpt'      => $this->faker->sentences(2, true),
            'user_id'      => User::inRandomOrder()->first()->id ?? 1,
            'category_id'  => Category::inRandomOrder()->first()->id ?? 1,
            'status'       => $this->faker->randomElement(['draft', 'published', 'published', 'published']),
            'published_at' => $this->faker->optional(0.75)->dateTimeBetween('-1 year', 'now'),
            'view_count'   => $this->faker->numberBetween(0, 50000),
        ];
    }

    // State: published
    public function published(): static
    {
        return $this->state(fn (array $attr) => [
            'status'       => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    // State: draft
    public function draft(): static
    {
        return $this->state(fn (array $attr) => [
            'status'       => 'draft',
            'published_at' => null,
        ]);
    }
}