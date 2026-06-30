<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            [
                'name' => 'Anil Gurung',
                'position' => 'Audit Manager',
                'bio' => 'Anil oversees audit engagements, ensuring accuracy and compliance with the highest industry standards.',
                'email' => 'anil.gurung@charter.com',
                'phone' => '+977-1-4445569',
                'linkedin_url' => 'https://linkedin.com/in/anil-gurung',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Meena Adhikari',
                'position' => 'HR Manager',
                'bio' => 'Meena fosters a supportive and inclusive workplace, driving talent acquisition and employee development.',
                'email' => 'meena.adhikari@charter.com',
                'phone' => '+977-1-4445570',
                'linkedin_url' => 'https://linkedin.com/in/meena-adhikari',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Suresh Bhattarai',
                'position' => 'IT Director',
                'bio' => 'Suresh leads our technology initiatives, ensuring robust systems and innovative digital solutions.',
                'email' => 'suresh.bhattarai@charter.com',
                'phone' => '+977-1-4445571',
                'linkedin_url' => 'https://linkedin.com/in/suresh-bhattarai',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Nisha Poudel',
                'position' => 'Senior Financial Advisor',
                'bio' => 'With over 15 years of experience in financial consulting, Nisha leads our team with a vision for innovation and client success.',
                'email' => 'nisha.poudel@charter.com',
                'phone' => '+977-1-4445572',
                'linkedin_url' => 'https://linkedin.com/in/nisha-poudel',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Hari Shrestha',
                'position' => 'Senior Tax Consultant',
                'bio' => 'Hari specializes in tax strategy, ensuring compliance and optimization for clients across diverse industries.',
                'email' => 'hari.shrestha@charter.com',
                'phone' => '+977-1-4445573',
                'linkedin_url' => 'https://linkedin.com/in/hari-shrestha',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Rita Bhandari',
                'position' => 'Business Analyst',
                'bio' => 'Rita drives strategic initiatives, helping clients achieve sustainable growth through tailored solutions.',
                'email' => 'rita.bhandari@charter.com',
                'phone' => '+977-1-4445574',
                'linkedin_url' => 'https://linkedin.com/in/rita-bhandari',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Kiran Lama',
                'position' => 'Senior Audit Associate',
                'bio' => 'Kiran oversees audit engagements, ensuring accuracy and compliance with the highest industry standards.',
                'email' => 'kiran.lama@charter.com',
                'phone' => '+977-1-4445575',
                'linkedin_url' => 'https://linkedin.com/in/kiran-lama',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Sita Rai',
                'position' => 'HR Associate',
                'bio' => 'Sita fosters a supportive and inclusive workplace, driving talent acquisition and employee development.',
                'email' => 'sita.rai@charter.com',
                'phone' => '+977-1-4445576',
                'linkedin_url' => 'https://linkedin.com/in/sita-rai',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Bikash Tamang',
                'position' => 'Systems Administrator',
                'bio' => 'Bikash leads our technology initiatives, ensuring robust systems and innovative digital solutions.',
                'email' => 'bikash.tamang@charter.com',
                'phone' => '+977-1-4445577',
                'linkedin_url' => 'https://linkedin.com/in/bikash-tamang',
                'sort_order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
