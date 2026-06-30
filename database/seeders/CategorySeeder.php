<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Latest trends and insights in technology',
                'icon' => null,
            ],
            [
                'name' => 'Business',
                'description' => 'Business strategies and market insights',
                'icon' => null,
            ],
            [
                'name' => 'Innovation',
                'description' => 'Innovative solutions and breakthrough ideas',
                'icon' => null,
            ],
            [
                'name' => 'Digital Transformation',
                'description' => 'Digital transformation strategies and case studies',
                'icon' => null,
            ],
            [
                'name' => 'Industry Insights',
                'description' => 'Deep dive into various industry sectors',
                'icon' => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
