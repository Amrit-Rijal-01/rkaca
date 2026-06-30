<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'AI',
            'Machine Learning',
            'Cloud Computing',
            'DevOps',
            'Automation',
            'Digital Strategy',
            'Cybersecurity',
            'Data Analytics',
            'Software Development',
            'Agile',
            'Innovation',
            'Leadership',
            'Productivity',
            'Best Practices',
            'Case Study',
            'Tutorial',
            'Research',
            'Trends',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
