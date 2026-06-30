<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->jobTitle();

        return [
            'title' => $title,
            'slug' => fake()->slug(),
            'description' => fake()->text(300),
            'department' => fake()->randomElement(['Engineering', 'Marketing', 'Sales', 'HR', 'Finance']),
            'location' => fake()->city().', '.fake()->state(),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'salary_min' => fake()->numberBetween(30000, 80000),
            'salary_max' => fake()->numberBetween(80000, 150000),
            'requirements' => fake()->paragraphs(3, true),
            'status' => 'active',
        ];
    }
}
