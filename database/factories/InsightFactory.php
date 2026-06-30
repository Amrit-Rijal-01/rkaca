<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insight>
 */
class InsightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'title' => $title,
            'slug' => fake()->slug(),
            'excerpt' => fake()->text(150),
            'content' => fake()->paragraphs(8, true),
            'featured_image' => 'https://picsum.photos/800/600?random='.fake()->numberBetween(1, 1000),
            'category' => fake()->randomElement(['Technology', 'Business', 'Innovation', 'Industry News']),
            'author' => fake()->name(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'status' => fake()->randomElement(['draft', 'published']),
        ];
    }
}
