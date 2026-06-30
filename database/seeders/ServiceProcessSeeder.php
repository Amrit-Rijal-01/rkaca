<?php

namespace Database\Seeders;

use App\Models\ServiceProcess;
use Illuminate\Database\Seeder;

class ServiceProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processes = [
            [
                'step_number' => 1,
                'title' => 'Discovery',
                'description' => 'Understanding your business, challenges, and objectives through comprehensive consultation.',
                'icon' => 'fas fa-search',
                'color' => '#20B2AA',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'step_number' => 2,
                'title' => 'Planning',
                'description' => 'Developing tailored strategies and detailed project plans aligned with your specific requirements.',
                'icon' => 'fas fa-clipboard-list',
                'color' => '#20B2AA',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'step_number' => 3,
                'title' => 'Execution',
                'description' => 'Implementing solutions with precision, maintaining regular communication and quality oversight.',
                'icon' => 'fas fa-cogs',
                'color' => '#20B2AA',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'step_number' => 4,
                'title' => 'Results',
                'description' => 'Delivering measurable outcomes and providing ongoing support for sustained success.',
                'icon' => 'fas fa-chart-line',
                'color' => '#20B2AA',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($processes as $process) {
            ServiceProcess::create($process);
        }
    }
}
