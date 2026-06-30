<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingAdminController extends Controller
{
    public function index()
    {
        $homeSetting = HomeSetting::getInstance();

        return view('admin.home-settings.index', compact('homeSetting'));
    }

    public function edit()
    {
        $homeSetting = HomeSetting::getInstance();

        return view('admin.home-settings.edit', compact('homeSetting'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'key_statistics_title' => 'required|string|max:255',
            'key_statistics_subtitle' => 'nullable|string',
            'why_choose_us_title' => 'required|string|max:255',
            'why_choose_us_subtitle' => 'nullable|string',
            'why_choose_us_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'why_choose_us_image_alt' => 'nullable|string|max:255',
            'home_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'statistics' => 'nullable|array',
            'statistics.*.label' => 'required|string|max:255',
            'statistics.*.number' => 'required|string|max:255',
            'features' => 'nullable|array',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'required|string',
            'features.*.icon' => 'nullable|string|max:255',
        ]);

        $homeSetting = HomeSetting::getInstance();

        // Handle image uploads
        $imagePath = $homeSetting->why_choose_us_image; // Keep existing image if no new upload
        if ($request->hasFile('why_choose_us_image')) {
            // Delete old image if it exists
            if ($homeSetting->why_choose_us_image && Storage::disk('public')->exists($homeSetting->why_choose_us_image)) {
                Storage::disk('public')->delete($homeSetting->why_choose_us_image);
            }

            // Store new image
            $imagePath = $request->file('why_choose_us_image')->store('home-settings', 'public');
        }

        $heroImagePath = $homeSetting->hero_image; // Keep existing hero image if no new upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image if it exists
            if ($homeSetting->hero_image && Storage::disk('public')->exists($homeSetting->hero_image)) {
                Storage::disk('public')->delete($homeSetting->hero_image);
            }

            // Store new hero image
            $heroImagePath = $request->file('hero_image')->store('home-settings', 'public');
        }

        $logoPath = $homeSetting->home_logo; // Keep existing logo if no new upload
        if ($request->hasFile('home_logo')) {
            // Delete old logo if it exists
            if ($homeSetting->home_logo && Storage::disk('public')->exists($homeSetting->home_logo)) {
                Storage::disk('public')->delete($homeSetting->home_logo);
            }

            // Store new logo
            $logoPath = $request->file('home_logo')->store('home-settings', 'public');
        }

        // Process statistics
        $statistics = [];
        if ($request->has('statistics')) {
            foreach ($request->statistics as $stat) {
                if (! empty($stat['label']) && ! empty($stat['number'])) {
                    $statistics[] = [
                        'label' => $stat['label'],
                        'number' => $stat['number'],
                    ];
                }
            }
        }

        // Process features
        $features = [];
        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                if (! empty($feature['title']) && ! empty($feature['description'])) {
                    $features[] = [
                        'title' => $feature['title'],
                        'description' => $feature['description'],
                        'icon' => $feature['icon'] ?? 'check',
                    ];
                }
            }
        }

        $homeSetting->update([
            'key_statistics_title' => $request->key_statistics_title,
            'key_statistics_subtitle' => $request->key_statistics_subtitle,
            'why_choose_us_title' => $request->why_choose_us_title,
            'why_choose_us_subtitle' => $request->why_choose_us_subtitle,
            'why_choose_us_image' => $imagePath,
            'why_choose_us_image_alt' => $request->why_choose_us_image_alt,
            'home_logo' => $logoPath,
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'hero_image' => $heroImagePath,
            'statistics' => $statistics,
            'features' => $features,
        ]);

        return redirect()->route('admin.home-settings.index')
            ->with('success', 'Home settings updated successfully.');
    }
}
