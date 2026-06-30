<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\IndustryExpertise;
use Illuminate\Http\Request;

class IndustryExpertiseAdminController extends Controller
{
    public function index()
    {
        $expertises = IndustryExpertise::ordered()->get();

        return view('admin.industry-expertise.index', compact('expertises'));
    }

    public function create()
    {
        return view('admin.industry-expertise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'svg_icon' => 'required|string',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'color_theme' => 'nullable|string|max:255',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        IndustryExpertise::create($validated);
        $this->render();

        return redirect()->route('admin.industry-expertise.index')
            ->with('success', 'Industry expertise created successfully.');
    }

    public function show(IndustryExpertise $industryExpertise)
    {
        return view('admin.industry-expertise.show', compact('industryExpertise'));
    }

    public function edit(IndustryExpertise $industryExpertise)
    {
        // dd($industryExpertise);
        return view('admin.industry-expertise.edit', compact('industryExpertise'));
    }

    public function update(Request $request, IndustryExpertise $industryExpertise)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'svg_icon' => 'required|string',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'color_theme' => 'nullable|string|max:255',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $industryExpertise->update($validated);
        $this->render();

        return redirect()->route('admin.industry-expertise.index')
            ->with('success', 'Industry expertise updated successfully.');
    }

    public function destroy(IndustryExpertise $industryExpertise)
    {
        $industryExpertise->delete();
        $this->render();

        return redirect()->route('admin.industry-expertise.index')
            ->with('success', 'Industry expertise deleted successfully.');
    }

    public function render()
    {
        $expertises = IndustryExpertise::active()->featured()->ordered()->get();
        Helper::putCache('industries.expertises', view('admin.template.industries.expertises', compact('expertises'))->render());
    }
}
