<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('kernel')->bootstrap();

use App\Models\Team;

// Check if teams exist
$teamCount = Team::count();
echo 'Current team count: '.$teamCount."\n";

if ($teamCount == 0) {
    echo "Seeding teams...\n";

    $teams = [
        [
            'name' => 'Priya Sharma',
            'position' => 'Managing Director',
            'bio' => 'With over 15 years of experience in financial consulting, Priya leads our team with a vision for innovation and client success.',
            'email' => 'priya.sharma@charter.com',
            'phone' => '+977-1-4445566',
            'linkedin_url' => 'https://linkedin.com/in/priya-sharma',
            'sort_order' => 1,
            'is_active' => true,
        ],
        [
            'name' => 'Rajesh Thapa',
            'position' => 'Head of Tax Advisory',
            'bio' => 'Rajesh specializes in tax strategy, ensuring compliance and optimization for clients across diverse industries.',
            'email' => 'rajesh.thapa@charter.com',
            'phone' => '+977-1-4445567',
            'linkedin_url' => 'https://linkedin.com/in/rajesh-thapa',
            'sort_order' => 2,
            'is_active' => true,
        ],
        [
            'name' => 'Sunita Karki',
            'position' => 'Director of Business Consulting',
            'bio' => 'Sunita drives strategic initiatives, helping clients achieve sustainable growth through tailored solutions.',
            'email' => 'sunita.karki@charter.com',
            'phone' => '+977-1-4445568',
            'linkedin_url' => 'https://linkedin.com/in/sunita-karki',
            'sort_order' => 3,
            'is_active' => true,
        ],
    ];

    foreach ($teams as $team) {
        Team::create($team);
    }

    echo "Teams seeded successfully!\n";
    echo 'New team count: '.Team::count()."\n";
} else {
    echo "Teams already exist!\n";
}
