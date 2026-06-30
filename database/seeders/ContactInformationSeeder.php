<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use Illuminate\Database\Seeder;

class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInformation::create([
            'title' => 'Main Office - Biratnagar',
            'address' => "Main Road, Biratnagar-15\nMorang, Nepal",
            'phone' => '+977-21-123456',
            'email' => 'info@charteredinsights.com',
            'website' => 'https://charteredinsights.com',
            'social_media_links' => [
                'linkedin' => 'https://linkedin.com/company/charteredinsights',
                'twitter' => 'https://twitter.com/charteredinsights',
                'facebook' => 'https://facebook.com/charteredinsights',
            ],
            'map_embed_url' => '', // To be filled by admin
            'google_maps_link' => 'https://maps.google.com',
            'business_hours' => [
                'monday' => '9:00 AM - 6:00 PM',
                'tuesday' => '9:00 AM - 6:00 PM',
                'wednesday' => '9:00 AM - 6:00 PM',
                'thursday' => '9:00 AM - 6:00 PM',
                'friday' => '9:00 AM - 6:00 PM',
                'saturday' => '9:00 AM - 2:00 PM',
                'sunday' => 'Closed',
            ],
            'additional_info' => 'Our team of experienced chartered accountants is ready to help with all your financial and business needs.',
            'is_active' => true,
        ]);
    }
}
