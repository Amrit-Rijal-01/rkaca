<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use App\Models\HomeSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Home Settings
        HomeSetting::getInstance();

        // Initialize Footer Settings
        FooterSetting::getInstance();

        $this->command->info('Settings initialized successfully!');
    }
}
