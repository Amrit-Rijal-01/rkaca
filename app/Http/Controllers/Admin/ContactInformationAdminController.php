<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationAdminController extends Controller
{
    /**
     * Display the settings page for contact information.
     */
    public function settings()
    {
        // Get the first (and ideally only) contact information record
        $contactInformation = ContactInformation::first();

        return view('admin.contact-information.settings', compact('contactInformation'));
    }

    /**
     * Save contact information (create or update).
     */
    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'map_embed_url' => 'nullable|url',
            'google_maps_link' => 'nullable|url',
            'additional_info' => 'nullable|string',
            'is_active' => 'boolean',

            // Social media links
            'social_media_links.facebook' => 'nullable|url',
            'social_media_links.twitter' => 'nullable|url',
            'social_media_links.linkedin' => 'nullable|url',
            'social_media_links.instagram' => 'nullable|url',
            'social_media_links.youtube' => 'nullable|url',

            // Business hours
            'business_hours.Monday' => 'nullable|string',
            'business_hours.Tuesday' => 'nullable|string',
            'business_hours.Wednesday' => 'nullable|string',
            'business_hours.Thursday' => 'nullable|string',
            'business_hours.Friday' => 'nullable|string',
            'business_hours.Saturday' => 'nullable|string',
            'business_hours.Sunday' => 'nullable|string',
        ]);

        // Handle checkbox
        $validated['is_active'] = $request->has('is_active');

        // Filter out empty social media links
        if (isset($validated['social_media_links'])) {
            $validated['social_media_links'] = array_filter($validated['social_media_links'], function ($value) {
                return ! empty($value);
            });
        }

        // Filter out empty business hours
        if (isset($validated['business_hours'])) {
            $validated['business_hours'] = array_filter($validated['business_hours'], function ($value) {
                return ! empty($value);
            });
        }

        // Update or create contact information
        $contactInformation = ContactInformation::first();

        if ($contactInformation) {
            $contactInformation->update($validated);
            $message = 'Contact information updated successfully.';
        } else {
            ContactInformation::create($validated);
            $message = 'Contact information created successfully.';
        }

        return redirect()->route('admin.contact-information.settings')
            ->with('success', $message);
    }
}
