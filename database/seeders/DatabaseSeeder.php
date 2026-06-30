<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user only if doesn't exist
        if (! User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
        User::factory(10)->create();

        // Create main pages
        if (! Page::where('slug', 'home')->exists()) {
            Page::factory()->create([
                'title' => 'Home',
                'slug' => 'home',
                'content' => '<h1>Welcome to Our Company</h1><p>This is the home page content.</p>',
                'status' => 'active',
            ]);
        }

        if (! Page::where('slug', 'about')->exists()) {
            Page::factory()->create([
                'title' => 'About Us',
                'slug' => 'about',
                'content' => '<h1>About Our Company</h1><p>Learn more about our company, mission, and values.</p>',
                'status' => 'active',
            ]);
        }
        $this->call([
            JumbotronSeeder::class,
            ServiceSeeder::class,
            ServiceProcessSeeder::class,
            IndustrySeeder::class,
            AboutSeeder::class,
            InsightSeeder::class,
            CareerSeeder::class,
            OfficeSeeder::class,
            SettingsSeeder::class,
            FooterSettingSeeder::class,
            IndustryExpertiseSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
        ]);
    }
}
