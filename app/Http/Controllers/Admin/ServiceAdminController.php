<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index()
    {
        $services = Service::with('parent')->latest()->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $parentServices = Service::topLevel()->ordered()->get();

        return view('admin.services.create', compact('parentServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services',
            'description' => 'required|string',
            'body' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_sub_service' => 'boolean',
            'parent_id' => 'nullable|required_if:is_sub_service,1|exists:services,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_sub_service'] = $request->has('is_sub_service');
        if (! $data['is_sub_service']) {
            $data['parent_id'] = null;
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
        $parentServices = Service::topLevel()->where('id', '!=', $service->id)->ordered()->get();

        return view('admin.services.edit', compact('service', 'parentServices'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,'.$service->id,
            'description' => 'required|string',
            'body' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_sub_service' => 'boolean',
            'parent_id' => 'nullable|required_if:is_sub_service,1|exists:services,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_sub_service'] = $request->has('is_sub_service');
        if (! $data['is_sub_service']) {
            $data['parent_id'] = null;
        }

        $service->update($data);
        $this->render();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        $this->render();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function render()
    {
        $services = Service::active()->topLevel()->ordered()->get();
        Helper::putCache('services.index', view('admin.template.services.index', compact('services'))->render());
        Helper::putCache('offices.services', view('admin.template.offices.services', compact('services'))->render());
        Helper::putCache('home.services', view('admin.template.home.services', compact('services'))->render());
    }
}
