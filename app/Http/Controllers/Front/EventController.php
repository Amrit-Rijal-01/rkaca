<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        // Get upcoming events (ordered by date)
        $upcomingEvents = Event::active()
            ->upcoming()
            ->orderBy('start_date', 'asc')
            ->get();

        // Get past events (ordered by date descending - most recent first)
        $pastEvents = Event::active()
            ->past()
            ->orderBy('start_date', 'desc')
            ->limit(6) // Limit to recent past events
            ->get();

        // Get unique event types for filter buttons
        $eventTypes = Event::active()
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->filter()
            ->map(function ($type) {
                return ucfirst($type);
            });

        $jumbotrons = DB::table('jumbotrons')
            ->where('page_slug', 'events')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('new.event', compact('upcomingEvents', 'pastEvents', 'eventTypes', 'jumbotrons'));
    }
}
