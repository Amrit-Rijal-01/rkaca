<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $offices = [
            [
                'name' => 'Kathmandu Office',
                'slug' => 'kathmandu-office',
                'type' => 'head_office',
                'address' => 'Chartered House, Durbar Marg, Kathmandu 44600, Nepal',
                'city' => 'Kathmandu',
                'state' => 'Bagmati',
                'country' => 'Nepal',
                'postal_code' => '44600',
                'phone' => '+977-1-4234567',
                'email' => 'kathmandu@charteredinsights.com',
                'office_hours' => "Sunday - Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM",
                'latitude' => 27.7172,
                'longitude' => 85.3240,
                'map_link' => 'https://maps.google.com/?q=27.7172,85.3240',
                'transportation' => "Public Transport Options:\n• Bus: Regular bus service from major areas\n• Micro: Available from Ratna Park, New Baneshwor\n• Taxi: Available 24/7\n• Ride-sharing: Pathao, Tootle available",
                'directions' => "From Tribhuvan International Airport:\n1. Take Ring Road towards Kathmandu\n2. Enter Durbar Marg from Putali Sadak\n3. Look for Chartered House building\n4. Office is on the 5th floor\n\nFrom New Baneshwor:\n1. Take micro/bus to Ratna Park\n2. Walk to Durbar Marg (5 minutes)\n3. Enter Chartered House",
                'parking_info' => "Free parking available:\n• 20 car parking slots\n• Covered parking\n• Security guard on duty\n• Visitor parking available",
                'appointment_link' => 'https://calendly.com/charteredinsights-ktm',
                'is_headquarters' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Pokhara Office',
                'slug' => 'pokhara-office',
                'type' => 'branch_office',
                'address' => 'Lake Side, Pokhara-6, Kaski, Nepal',
                'city' => 'Pokhara',
                'state' => 'Gandaki',
                'country' => 'Nepal',
                'postal_code' => '33700',
                'phone' => '+977-61-465432',
                'email' => 'pokhara@charteredinsights.com',
                'office_hours' => "Sunday - Friday: 9:30 AM - 5:30 PM\nSaturday: 10:00 AM - 3:00 PM",
                'latitude' => 28.2096,
                'longitude' => 83.9856,
                'map_link' => 'https://maps.google.com/?q=28.2096,83.9856',
                'transportation' => "Transportation:\n• Local Bus: Available from Bus Park\n• Taxi: Readily available\n• Motorcycle Taxi: Local service\n• Walking: 10 minutes from Lakeside main area",
                'directions' => "From Pokhara Airport:\n1. Take taxi towards Lakeside (15 minutes)\n2. Ask for Chartered Insights office\n3. Located near Royal Palace Hotel\n\nFrom Bus Park:\n1. Take local bus to Lakeside\n2. Get off at Royal Palace Hotel stop\n3. Office is 2 minutes walk",
                'parking_info' => "Parking facilities:\n• 10 motorcycle parking\n• 5 car parking slots\n• Street parking available\n• No parking fees",
                'appointment_link' => 'https://calendly.com/charteredinsights-pkr',
                'is_headquarters' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Chitwan Office',
                'slug' => 'chitwan-office',
                'type' => 'branch_office',
                'address' => 'Narayangarh-4, Bharatpur, Chitwan, Nepal',
                'city' => 'Bharatpur',
                'state' => 'Bagmati',
                'country' => 'Nepal',
                'postal_code' => '44200',
                'phone' => '+977-56-526789',
                'email' => 'chitwan@charteredinsights.com',
                'office_hours' => "Sunday - Friday: 9:00 AM - 5:00 PM\nSaturday: Closed",
                'latitude' => 27.6588,
                'longitude' => 84.4336,
                'map_link' => 'https://maps.google.com/?q=27.6588,84.4336',
                'transportation' => "Local Transport:\n• Local Bus: From bus station\n• Rickshaw: Available throughout city\n• Taxi: Limited but available\n• Walking: Central location, walkable",
                'directions' => "From Bharatpur Bus Station:\n1. Take rickshaw to Narayangarh main road\n2. Look for our office sign\n3. Ground floor of Chitwan Plaza\n\nFrom Chitwan Airport:\n1. Take taxi to Narayangarh (20 minutes)\n2. Office is on main road",
                'parking_info' => "Parking options:\n• 8 car parking spaces\n• Motorcycle parking available\n• Street parking during office hours\n• Free parking for clients",
                'appointment_link' => 'https://calendly.com/charteredinsights-ctw',
                'is_headquarters' => false,
                'status' => 'active',
            ],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
