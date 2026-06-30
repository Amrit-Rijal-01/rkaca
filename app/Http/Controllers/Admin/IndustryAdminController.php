<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndustryAdminController extends Controller
{
    public function index()
    {
        $industries = Industry::latest()->paginate(15);

        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'svg_icon' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle arrays
        if ($request->has('features') && is_array($request->features)) {
            $data['features'] = array_filter($request->features);
        }

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('industries', 'public');
        }

        Industry::create($data);
        $this->render();

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry created successfully.');
    }

    public function show(Industry $industry)
    {
        return view('admin.industries.show', compact('industry'));
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries,slug,'.$industry->id,
            'description' => 'required|string',
            'content' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'svg_icon' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle arrays
        if ($request->has('features') && is_array($request->features)) {
            $data['features'] = array_filter($request->features);
        }

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            if ($industry->featured_image) {
                Storage::disk('public')->delete($industry->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('industries', 'public');
        }

        $industry->update($data);
        $this->render();

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        // Delete associated images
        if ($industry->featured_image) {
            Storage::disk('public')->delete($industry->featured_image);
        }
        if ($industry->icon) {
            Storage::disk('public')->delete($industry->icon);
        }

        $industry->delete();
        $this->render();

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry deleted successfully.');
    }

    public function render()
    {
        $industries = Industry::active()->ordered()->get();
        Helper::putCache('industries.index', view('admin.template.industries.index', compact('industries'))->render());
        Helper::putCache('services.industries', view('admin.template.services.industries', compact('industries'))->render());
        Helper::putCache('home.industries', view('admin.template.home.industries', compact('industries'))->render());
    }
}
