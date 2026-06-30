<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => fake()->slug(),
            'description' => fake()->text(200),
            'content' => fake()->paragraphs(5, true),
            'featured_image' => 'https://picsum.photos/600/400?random='.fake()->numberBetween(1, 1000),
            'icon' => fake()->randomElement(['fas fa-code', 'fas fa-design', 'fas fa-mobile', 'fas fa-cloud']),
            'status' => 'active',
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
