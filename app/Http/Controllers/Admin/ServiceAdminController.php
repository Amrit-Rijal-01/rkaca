<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'price' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:255',
            'sub_service_titles' => 'nullable|array',
            'sub_service_titles.*' => 'string|max:255',
            'sub_service_items' => 'nullable|array',
            'sub_service_items.*' => 'nullable|array',
            'sub_service_items.*.*' => 'string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'svg_icon' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle arrays
        if ($request->has('features') && is_array($request->features)) {
            $data['features'] = array_filter($request->features);
        }
        if ($request->has('benefits') && is_array($request->benefits)) {
            $data['benefits'] = array_filter($request->benefits);
        }

        // Handle sub-services
        if ($request->has('sub_service_titles') && $request->has('sub_service_items')) {
            $subServices = [];
            $titles = array_filter($request->sub_service_titles);
            $items = $request->sub_service_items ?? [];

            foreach ($titles as $index => $title) {
                if (! empty($title) && isset($items[$index]) && is_array($items[$index])) {
                    $subServices[$title] = array_filter($items[$index]);
                }
            }
            $data['sub_services'] = $subServices;
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        Service::create($data);
        $this->render();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,'.$service->id,
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'price' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'sub_service_titles' => 'nullable|array',
            'sub_service_titles.*' => 'string|max:255',
            'sub_service_items' => 'nullable|array',
            'sub_service_items.*' => 'nullable|array',
            'sub_service_items.*.*' => 'string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'svg_icon' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle arrays
        if ($request->has('features') && is_array($request->features)) {
            $data['features'] = array_filter($request->features);
        }
        if ($request->has('benefits') && is_array($request->benefits)) {
            $data['benefits'] = array_filter($request->benefits);
        }

        // Handle sub-services
        if ($request->has('sub_service_titles') && $request->has('sub_service_items')) {
            $subServices = [];
            $titles = array_filter($request->sub_service_titles);
            $items = $request->sub_service_items ?? [];

            foreach ($titles as $index => $title) {
                if (! empty($title) && isset($items[$index]) && is_array($items[$index])) {
                    $subServices[$title] = array_filter($items[$index]);
                }
            }
            $data['sub_services'] = $subServices;
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($service->featured_image) {
                Storage::disk('public')->delete($service->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        $service->update($data);
        $this->render();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        // Delete associated image
        if ($service->featured_image) {
            Storage::disk('public')->delete($service->featured_image);
        }

        $service->delete();
        $this->render();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function render()
    {
        $services = Service::active()->ordered()->get();
        Helper::putCache('services.index', view('admin.template.services.index', compact('services'))->render());
        Helper::putCache('offices.services', view('admin.template.offices.services', compact('services'))->render());
        Helper::putCache('home.services', view('admin.template.home.services', compact('services'))->render());
    }
}
