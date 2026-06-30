<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\About;
use App\Models\AboutCoreValue;
use App\Models\AboutExpertiseArea;
use App\Models\AboutTeamMember;
use App\Models\AboutWhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutAdminController extends Controller
{
    public function index()
    {
        $about = About::with([
            'coreValues' => function ($query) {
                $query->orderBy('sort_order');
            },
            'teamMembers' => function ($query) {
                $query->orderBy('sort_order');
            },
            'expertiseAreas' => function ($query) {
                $query->orderBy('sort_order');
            },
            'whyChooseUsItems' => function ($query) {
                $query->orderBy('sort_order');
            },
        ])->first();

        return view('admin.about.index', compact('about'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'our_story_title' => 'required|string|max:255',
            'our_story_content' => 'required|string',
            'our_story_image' => 'nullable|image|max:2048',
            'core_values_title' => 'required|string|max:255',
            'core_values_subtitle' => 'required|string',
            'leadership_title' => 'required|string|max:255',
            'leadership_subtitle' => 'required|string',
            'expertise_title' => 'required|string|max:255',
            'expertise_subtitle' => 'required|string',
            'why_choose_us_title' => 'required|string|max:255',
            'why_choose_us_subtitle' => 'required|string',
        ]);

        $data = $request->except(['our_story_image']);

        if ($request->hasFile('our_story_image')) {
            $data['our_story_image'] = $request->file('our_story_image')->store('about', 'public');
        }

        $about = About::updateOrCreate(['id' => 1], $data);
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'About page content updated successfully!');
    }

    // Core Values Management
    public function storeCoreValue(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_svg' => 'nullable|string',
            'sort_order' => 'required|integer',
        ]);

        $about = About::firstOrCreate(['id' => 1]);

        $about->coreValues()->create($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Core value added successfully!');
    }

    public function updateCoreValue(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_svg' => 'nullable|string',
            'sort_order' => 'required|integer',
        ]);

        $coreValue = AboutCoreValue::findOrFail($id);
        $coreValue->update($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Core value updated successfully!');
    }

    public function deleteCoreValue($id)
    {
        AboutCoreValue::findOrFail($id)->delete();
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Core value deleted successfully!');
    }

    // Team Members Management
    public function storeTeamMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'email' => 'nullable|email',
            'sort_order' => 'required|integer',
        ]);

        $about = About::firstOrCreate(['id' => 1]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $about->teamMembers()->create($data);
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Team member added successfully!');
    }

    public function updateTeamMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'email' => 'nullable|email',
            'sort_order' => 'required|integer',
        ]);

        $teamMember = AboutTeamMember::findOrFail($id);
        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $teamMember->update($data);
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Team member updated successfully!');
    }

    public function deleteTeamMember($id)
    {
        $teamMember = AboutTeamMember::findOrFail($id);
        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }
        $teamMember->delete();
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Team member deleted successfully!');
    }

    // Expertise Areas Management
    public function storeExpertiseArea(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $about = About::firstOrCreate(['id' => 1]);
        $about->expertiseAreas()->create($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Expertise area added successfully!');
    }

    public function updateExpertiseArea(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $expertiseArea = AboutExpertiseArea::findOrFail($id);
        $expertiseArea->update($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Expertise area updated successfully!');
    }

    public function deleteExpertiseArea($id)
    {
        AboutExpertiseArea::findOrFail($id)->delete();
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Expertise area deleted successfully!');
    }

    // Why Choose Us Management
    public function storeWhyChooseUs(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $about = About::firstOrCreate(['id' => 1]);
        $about->whyChooseUsItems()->create($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Why choose us item added successfully!');
    }

    public function updateWhyChooseUs(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $whyChooseUs = AboutWhyChooseUs::findOrFail($id);
        $whyChooseUs->update($request->all());
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Why choose us item updated successfully!');
    }

    public function deleteWhyChooseUs($id)
    {
        AboutWhyChooseUs::findOrFail($id)->delete();
        $this->renderAboutMainContent();

        return redirect()->back()->with('success', 'Why choose us item deleted successfully!');
    }

    // Toggle Active Status
    public function toggleCoreValueStatus($id)
    {
        $coreValue = AboutCoreValue::findOrFail($id);
        $coreValue->update(['is_active' => ! $coreValue->is_active]);

        return redirect()->back()->with('success', 'Core value status updated!');
    }

    public function toggleTeamMemberStatus($id)
    {
        $teamMember = AboutTeamMember::findOrFail($id);
        $teamMember->update(['is_active' => ! $teamMember->is_active]);

        return redirect()->back()->with('success', 'Team member status updated!');
    }

    public function toggleExpertiseAreaStatus($id)
    {
        $expertiseArea = AboutExpertiseArea::findOrFail($id);
        $expertiseArea->update(['is_active' => ! $expertiseArea->is_active]);

        return redirect()->back()->with('success', 'Expertise area status updated!');
    }

    public function toggleWhyChooseUsStatus($id)
    {
        $whyChooseUs = AboutWhyChooseUs::findOrFail($id);
        $whyChooseUs->update(['is_active' => ! $whyChooseUs->is_active]);

        return redirect()->back()->with('success', 'Why choose us item status updated!');
    }

    public function renderAboutMainContent()
    {
        $about = \App\Models\About::with([
            'coreValues' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            },
            'teamMembers' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            },
            'expertiseAreas' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            },
            'whyChooseUsItems' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            },
        ])->where('is_active', true)->first();
        Helper::putCache('about.index', view('admin.template.about.main', compact('about')));
    }
}
