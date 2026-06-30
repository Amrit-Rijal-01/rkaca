<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OfficeAdminController extends Controller
{
    public function index()
    {
        $offices = Office::latest()->paginate(15);

        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'office_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'map_link' => 'nullable|url',
            'transportation' => 'nullable|string',
            'directions' => 'nullable|string',
            'parking_info' => 'nullable|string',
            'appointment_link' => 'nullable|url',
            'is_headquarters' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['is_headquarters'] = $request->has('is_headquarters');
        $data['slug'] = Str::slug($request->name);
        $data['type'] = 'head_office';
        // Handle file upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('offices', 'public');
        }

        Office::create($data);
        $this->render();

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office created successfully.');
    }

    public function show(Office $office)
    {
        return view('admin.offices.show', compact('office'));
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:head_office,branch_office',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'office_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'map_link' => 'nullable|url',
            'transportation' => 'nullable|string',
            'directions' => 'nullable|string',
            'parking_info' => 'nullable|string',
            'appointment_link' => 'nullable|url',
            'is_headquarters' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['is_headquarters'] = $request->has('is_headquarters');
        $data['slug'] = Str::slug($request->name);

        // Handle file upload
        if ($request->hasFile('image')) {
            if ($office->image) {
                Storage::disk('public')->delete($office->image);
            }
            $data['image'] = $request->file('image')->store('offices', 'public');
        }

        $office->update($data);
        $this->render();

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        // Delete associated image
        if ($office->image) {
            Storage::disk('public')->delete($office->image);
        }

        $office->delete();
        $this->render();

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office deleted successfully.');
    }

    public function render()
    {
        $offices = Office::active()->get();
        Helper::putCache('office.index', view('admin.template.office.index', compact('offices'))->render());
    }
}
