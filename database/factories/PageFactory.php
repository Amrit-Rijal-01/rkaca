<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
            'content' => fake()->paragraphs(5, true),
            'meta_title' => $title,
            'meta_description' => fake()->text(160),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
