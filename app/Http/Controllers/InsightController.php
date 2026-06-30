<?php

namespace App\Http\Controllers;

use App\Models\Insight;

class InsightController extends Controller
{
    public function index()
    {
        $insights = Insight::published()->latest()->paginate(9);

        return view('insights', compact('insights'));
    }

    public function show($slug)
    {
        $insight = Insight::where('slug', $slug)->published()->firstOrFail();

        return view('insight-detail', compact('insight'));
    }
}
