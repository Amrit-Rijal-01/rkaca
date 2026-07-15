<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use Illuminate\Support\Facades\DB;

class InsightsController extends Controller
{
    public function index()
    {
        $insights = Insight::where('status', 'published')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $insightLatest = Insight::where('status', 'published')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->get();

        $jumbotrons = DB::table('jumbotrons')
            ->where('page_slug', 'insights')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('new.insights', compact('insights', 'insightLatest', 'jumbotrons'));
    }
}
