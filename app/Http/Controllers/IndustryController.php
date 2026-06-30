<?php

namespace App\Http\Controllers;

use App\Models\Industry;

class IndustryController extends Controller
{
    public function index()
    {
        return view('industries');
    }

    public function show($slug)
    {
        $industry = Industry::where('slug', $slug)->active()->firstOrFail();

        return view('industry-detail', compact('industry'));
    }
}
