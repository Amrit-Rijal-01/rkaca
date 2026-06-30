<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jumbotron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JumbotronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Group jumbotrons by page slug for better organization
        $jumbotrons = Jumbotron::orderBy('page_slug')
            ->orderBy('slide_order')
            ->get()
            ->groupBy('page_slug');

        $availablePages = Jumbotron::getAvailablePageSlugs();

        return view('admin.jumbotrons.index', compact('jumbotrons', 'availablePages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $availablePages = Jumbotron::getAvailablePageSlugs();
        $pageSlug = $request->get('page_slug');

        // If page_slug is provided and it supports multi-slide, allow creating multiple
        if ($pageSlug && Jumbotron::supportsMultiSlide($pageSlug)) {
            $isMultiSlide = true;
            $nextSlideOrder = Jumbotron::getNextSlideOrder($pageSlug);
        } else {
            $isMultiSlide = false;
            $nextSlideOrder = 1;
            // For single-slide pages, filter out already used page slugs
            $usedSlugs = Jumbotron::pluck('page_slug')->unique()->toArray();
            $availablePages = array_diff_key($availablePages, array_flip($usedSlugs));
        }

        return view('admin.jumbotrons.create', compact('availablePages', 'pageSlug', 'isMultiSlide', 'nextSlideOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isMultiSlide = $request->boolean('is_multi_slide');

        $rules = [
            'page_slug' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'slide_order' => 'integer|min:1',
        ];

        // For single-slide pages, ensure page_slug is unique
        if (! $isMultiSlide) {
            $rules['page_slug'] .= '|unique:jumbotrons,page_slug';
        }

        $request->validate($rules);

        $data = $request->only(['page_slug', 'title', 'subtitle', 'is_active', 'button_text', 'button_link', 'slide_order']);
        $data['is_active'] = $request->has('is_active');
        $data['is_multi_slide'] = $isMultiSlide;

        // Set slide order
        if (! $data['slide_order']) {
            $data['slide_order'] = Jumbotron::getNextSlideOrder($data['page_slug']);
        }

        // Handle image upload
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $filename = time().'_'.Str::slug($data['page_slug']).'_'.$data['slide_order'].'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('jumbotrons', $filename, 'public');
            $data['background_image_url'] = Storage::url($path);
        }

        $jumbotron = Jumbotron::create($data);

        // Clear cache
        \App\Helpers\JumbotronHelper::clearCache($data['page_slug']);

        $message = $isMultiSlide ? 'Slide created successfully.' : 'Jumbotron created successfully.';

        return redirect()->route('admin.jumbotrons.index')
            ->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jumbotron $jumbotron)
    {
        return view('admin.jumbotrons.show', compact('jumbotron'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jumbotron $jumbotron)
    {
        $availablePages = Jumbotron::getAvailablePageSlugs();
        $isMultiSlide = $jumbotron->is_multi_slide;

        return view('admin.jumbotrons.edit', compact('jumbotron', 'availablePages', 'isMultiSlide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jumbotron $jumbotron)
    {
        $isMultiSlide = $jumbotron->is_multi_slide;

        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'slide_order' => 'integer|min:1',
        ];

        // For single-slide pages, allow page_slug change if unique
        if (! $isMultiSlide) {
            $rules['page_slug'] = 'required|string|unique:jumbotrons,page_slug,'.$jumbotron->id;
        }

        $request->validate($rules);

        $data = $request->only(['title', 'subtitle', 'is_active', 'button_text', 'button_link', 'slide_order']);
        $data['is_active'] = $request->has('is_active');

        // Only allow page_slug change for single-slide pages
        if (! $isMultiSlide && $request->has('page_slug')) {
            $data['page_slug'] = $request->page_slug;
        }

        // Handle image upload
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($jumbotron->background_image_url) {
                $oldPath = str_replace('/storage/', '', $jumbotron->background_image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('background_image');
            $filename = time().'_'.Str::slug($jumbotron->page_slug).'_'.$data['slide_order'].'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('jumbotrons', $filename, 'public');
            $data['background_image_url'] = Storage::url($path);
        }

        $jumbotron->update($data);

        // Clear cache
        \App\Helpers\JumbotronHelper::clearCache($jumbotron->page_slug);

        $message = $isMultiSlide ? 'Slide updated successfully.' : 'Jumbotron updated successfully.';

        return redirect()->route('admin.jumbotrons.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jumbotron $jumbotron)
    {
        $pageSlug = $jumbotron->page_slug;

        // Delete associated image
        if ($jumbotron->background_image_url) {
            $oldPath = str_replace('/storage/', '', $jumbotron->background_image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $jumbotron->delete();

        // Clear cache
        \App\Helpers\JumbotronHelper::clearCache($pageSlug);

        $message = $jumbotron->is_multi_slide ? 'Slide deleted successfully.' : 'Jumbotron deleted successfully.';

        return redirect()->route('admin.jumbotrons.index')
            ->with('success', $message);
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(Jumbotron $jumbotron)
    {
        $jumbotron->update(['is_active' => ! $jumbotron->is_active]);

        // Clear cache for this jumbotron
        \App\Helpers\JumbotronHelper::clearCache($jumbotron->page_slug);

        return redirect()->route('admin.jumbotrons.index')
            ->with('success', 'Status updated successfully.');
    }

    /**
     * Reorder slides for a multi-slide page
     */
    public function reorderSlides(Request $request)
    {
        $request->validate([
            'page_slug' => 'required|string',
            'slide_ids' => 'required|array',
            'slide_ids.*' => 'integer|exists:jumbotrons,id',
        ]);

        $pageSlug = $request->page_slug;
        $slideIds = $request->slide_ids;

        // Update the slide order
        foreach ($slideIds as $index => $slideId) {
            Jumbotron::where('id', $slideId)
                ->where('page_slug', $pageSlug)
                ->update(['slide_order' => $index + 1]);
        }

        // Clear cache
        \App\Helpers\JumbotronHelper::clearCache($pageSlug);

        return response()->json(['success' => true, 'message' => 'Slides reordered successfully.']);
    }
}
