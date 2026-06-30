<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        // Get careers from existing Career model (for individual career posts)

        return view('careers');
    }

    public function show($slug)
    {
        $career = Career::where('slug', $slug)->active()->firstOrFail();

        return view('career-detail', compact('career'));
    }

    public function showJob($id)
    {
        $job = JobOpening::active()->findOrFail($id);

        return view('careers.job-detail', compact('job'));
    }

    public function getJobsByCategory(Request $request)
    {
        $category = $request->get('category', 'all');

        $query = JobOpening::active()->ordered();

        if ($category !== 'all') {
            $query->byCategory($category);
        }

        $jobs = $query->get();

        return response()->json([
            'jobs' => $jobs->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'department' => $job->department,
                    'location' => $job->location,
                    'job_type' => $job->job_type,
                    'category' => $job->category,
                    'overview' => $job->overview,
                    'responsibilities_array' => $job->responsibilities_array,
                    'requirements_array' => $job->requirements_array,
                    'benefits_array' => $job->benefits_array,
                    'formatted_salary' => $job->formatted_salary,
                ];
            }),
        ]);
    }
}
