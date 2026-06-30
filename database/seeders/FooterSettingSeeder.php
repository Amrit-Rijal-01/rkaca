<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        FooterSetting::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'Roshan Kumar & Associates',
                'company_tagline' => 'Chartered Accountants',
                'company_slogan' => 'Empowering Wealth Creation Through Expert Financial Guidance',
                'address' => 'Putalisadak, Kathmandu, Nepal',
                'phone' => '+977-1-4441234',
                'email' => 'info@rkassociates.com.np',
                'social_links' => json_encode([
                    'facebook' => 'https://facebook.com/rkassociates',
                    'linkedin' => 'https://linkedin.com/company/roshan-kumar-associates',
                    'twitter' => 'https://twitter.com/rkassociates',
                    'instagram' => 'https://instagram.com/rkassociates',
                ]),
                'quick_links' => json_encode([
                    ['label' => 'About Us', 'url' => '/about'],
                    ['label' => 'Our Services', 'url' => '/services'],
                    ['label' => 'Industries', 'url' => '/industries'],
                    ['label' => 'Insights & Blog', 'url' => '/insights'],
                    ['label' => 'Career Opportunities', 'url' => '/careers'],
                    ['label' => 'Contact Us', 'url' => '/contact'],
                    ['label' => 'Client Portal', 'url' => '/portal'],
                ]),
                'copyright_text' => '© 2025 Roshan Kumar & Associates. All rights reserved. | Chartered Accountants Firm in Nepal',
            ]
        );
    }
}
