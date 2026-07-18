<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events',
            'type' => 'required|in:webinar,workshop,conference,training',
            'short_description' => 'required|string|max:500',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'venue_type' => 'nullable|in:online,physical,hybrid',
            'price' => 'nullable|numeric|min:0',
            'early_bird_price' => 'nullable|numeric|min:0',
            'registration_link' => 'nullable|url',
            'recording_link' => 'nullable|url',
            'resources_link' => 'nullable|url',
            'max_participants' => 'nullable|integer|min:1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'is_free' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_free'] = $request->has('is_free');

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('events', 'public');
        }
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('events/pdfs', 'public');
        }

        Event::create($data);
        $this->render();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:events,slug,'.$event->id,
            'type' => 'required|in:webinar,workshop,conference,training',
            'short_description' => 'required|string|max:500',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'venue_type' => 'nullable|in:online,physical,hybrid',
            'price' => 'nullable|numeric|min:0',
            'early_bird_price' => 'nullable|numeric|min:0',
            'registration_link' => 'nullable|url',
            'recording_link' => 'nullable|url',
            'resources_link' => 'nullable|url',
            'max_participants' => 'nullable|integer|min:1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive,draft',
            'is_featured' => 'boolean',
            'is_free' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_free'] = $request->has('is_free');

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            if ($event->featured_image) {
                Storage::disk('public')->delete($event->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('events', 'public');
        }
        if ($request->hasFile('pdf_file')) {
            if ($event->pdf_file) {
                Storage::disk('public')->delete($event->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('events/pdfs', 'public');
        }

        $event->update($data);
        $this->render();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete associated files
        if ($event->featured_image) {
            Storage::disk('public')->delete($event->featured_image);
        }
        if ($event->pdf_file) {
            Storage::disk('public')->delete($event->pdf_file);
        }

        $event->delete();
        $this->render();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function render()
    {
        // Get featured upcoming event
        $featuredEvent = Event::where('status', 'active')
            ->where('is_featured', true)
            ->first();

        // Get other upcoming events (excluding featured)
        $upcomingEventsQuery = Event::active()
            ->upcoming()
            ->latest();

        if ($featuredEvent) {
            $upcomingEventsQuery->where('id', '!=', $featuredEvent->id);
        }

        $upcomingEvents = $upcomingEventsQuery->take(6)->get();

        // Get past events with recordings
        $pastEvents = Event::active()
            ->past()
            ->whereNotNull('recording_link')
            ->latest()
            ->take(6)
            ->get();

        // Get event types for filters
        $eventTypes = Event::active()->distinct()->pluck('type');
        Helper::putCache('events.index', view('admin.template.events.index', compact(
            'featuredEvent',
            'upcomingEvents',
            'pastEvents',
            'eventTypes'
        ))->render());
    }
}
