<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingAdminController extends Controller
{
    public function index()
    {
        $footerSetting = FooterSetting::getInstance();

        return view('admin.footer-settings.index', compact('footerSetting'));
    }

    public function edit()
    {
        $footerSetting = FooterSetting::getInstance();

        return view('admin.footer-settings.edit', compact('footerSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'nullable|string|max:255',
            'company_slogan' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'copyright_text' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'quick_links' => 'nullable|array',
            'quick_links.*.label' => 'required|string|max:255',
            'quick_links.*.url' => 'required|string|max:255',
        ]);

        $footerSetting = FooterSetting::getInstance();

        // Process social links
        $socialLinks = [];
        if ($request->has('social_links')) {
            foreach ($request->social_links as $platform => $url) {
                if (! empty($url)) {
                    $socialLinks[$platform] = $url;
                }
            }
        }

        // Process quick links
        $quickLinks = [];
        if ($request->has('quick_links')) {
            foreach ($request->quick_links as $link) {
                if (! empty($link['label']) && ! empty($link['url'])) {
                    $quickLinks[] = [
                        'label' => $link['label'],
                        'url' => $link['url'],
                    ];
                }
            }
        }

        $footerSetting->update([
            'company_name' => $request->company_name,
            'company_tagline' => $request->company_tagline,
            'company_slogan' => $request->company_slogan,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'copyright_text' => $request->copyright_text,
            'social_links' => $socialLinks,
            'quick_links' => $quickLinks,
        ]);

        return redirect()->route('admin.footer-settings.index')
            ->with('success', 'Footer settings updated successfully.');
    }
}
