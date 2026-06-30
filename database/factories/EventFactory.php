<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        $startDate = fake()->dateTimeBetween('now', '+3 months');
        $endDateMax = (clone $startDate)->modify('+1 month');

        return [
            'title' => $title,
            'slug' => fake()->slug(),
            'description' => fake()->paragraphs(2, true),
            'location' => fake()->city().', '.fake()->state(),
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, $endDateMax),
            'featured_image' => 'https://picsum.photos/800/600?random='.fake()->numberBetween(1, 1000),
            'status' => 'active',
        ];
    }
}
