<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            'Managing Director',
            'Head of Tax Advisory',
            'Director of Business Consulting',
            'Audit Manager',
            'HR Manager',
            'IT Director',
            'Senior Tax Consultant',
            'Business Analyst',
            'Financial Advisor',
            'Compliance Officer',
            'Legal Advisor',
            'Operations Manager',
        ];

        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->randomElement($positions),
            'bio' => $this->faker->paragraph(3),
            'image' => null, // Will be set in seeder if needed
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'linkedin_url' => $this->faker->optional(0.7)->url(),
            'twitter_url' => $this->faker->optional(0.5)->url(),
            'facebook_url' => $this->faker->optional(0.4)->url(),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
