<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_opening_id' => 'nullable|exists:job_openings,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'portfolio_url' => 'nullable|url',
            'linkedin_profile' => 'nullable|url',
            'expected_salary' => 'nullable|numeric|min:0',
            'available_start_date' => 'nullable|date|after:today',
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $validated['resume_path'] = $resumePath;
        }

        // Remove the file from validated data since we stored the path
        unset($validated['resume']);

        // Create the application
        $application = JobApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your application has been submitted successfully! We will review it and get back to you soon.',
            'application_id' => $application->id,
        ]);
    }

    public function create($jobId = null)
    {
        $job = null;
        if ($jobId) {
            $job = JobOpening::active()->findOrFail($jobId);
        }

        return view('careers.apply', compact('job'));
    }

    public function generalApplication()
    {
        return view('careers.general-apply');
    }
}
