<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerBenefit;
use App\Models\CareerTestimonial;
use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerAdminController extends Controller
{
    // Main careers management dashboard
    public function index()
    {
        return redirect()->route('admin.careers.benefits');
    }

    // Career Benefits Management
    public function benefits()
    {
        $benefits = CareerBenefit::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.careers.benefits', compact('benefits'));
    }

    public function storeBenefit(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'color_class' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        CareerBenefit::create($validated);
        $this->render();

        return redirect()->route('admin.careers.benefits')->with('success', 'Benefit added successfully!');
    }

    public function updateBenefit(Request $request, CareerBenefit $benefit)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'color_class' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $benefit->update($validated);
        $this->render();

        return redirect()->route('admin.careers.benefits')->with('success', 'Benefit updated successfully!');
    }

    public function destroyBenefit(CareerBenefit $benefit)
    {
        $benefit->delete();
        $this->render();

        return redirect()->route('admin.careers.benefits')->with('success', 'Benefit deleted successfully!');
    }

    // Job Openings Management
    public function jobs()
    {
        $jobs = JobOpening::all();

        return view('admin.careers.jobs', compact('jobs'));
    }

    public function createJob()
    {
        return view('admin.careers.jobs-create');
    }

    public function storeJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'experience_level' => 'required|in:entry,mid,senior,lead,executive',
            'description' => 'required|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'nullable|string',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'application_deadline' => 'nullable|date',
            'positions_available' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Filter out empty strings from arrays
        if (isset($validated['responsibilities'])) {
            $validated['responsibilities'] = array_filter($validated['responsibilities'], function ($item) {
                return ! empty(trim($item));
            });
        }
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function ($item) {
                return ! empty(trim($item));
            });
        }
        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function ($item) {
                return ! empty(trim($item));
            });
        }

        JobOpening::create($validated);
        $this->render();

        return redirect()->route('admin.careers.jobs')->with('success', 'Job opening created successfully!');
    }

    public function editJob(JobOpening $job)
    {
        // dd($job);
        return view('admin.careers.jobs-edit', compact('job'));
    }

    public function updateJob(Request $request, JobOpening $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full_time,part_time,contract,internship',
            'experience_level' => 'required|in:entry,mid,senior,lead,executive',
            'description' => 'required|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'nullable|string',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'application_deadline' => 'nullable|date',
            'positions_available' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Filter out empty strings from arrays
        if (isset($validated['responsibilities'])) {
            $validated['responsibilities'] = array_filter($validated['responsibilities'], function ($item) {
                return ! empty(trim($item));
            });
        }
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function ($item) {
                return ! empty(trim($item));
            });
        }
        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function ($item) {
                return ! empty(trim($item));
            });
        }

        $job->update($validated);
        $this->render();

        return redirect()->route('admin.careers.jobs')->with('success', 'Job opening updated successfully!');
    }

    public function destroyJob(JobOpening $job)
    {
        $job->delete();
        $this->render();

        return redirect()->route('admin.careers.jobs')->with('success', 'Job opening deleted successfully!');
    }

    // Testimonials Management
    public function testimonials()
    {
        $testimonials = CareerTestimonial::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.careers.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'years_with_company' => 'nullable|integer',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        CareerTestimonial::create($validated);
        $this->render();

        return redirect()->route('admin.careers.testimonials')->with('success', 'Testimonial added successfully!');
    }

    public function updateTestimonial(Request $request, CareerTestimonial $testimonial)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'years_with_company' => 'nullable|integer',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        $this->render();

        return redirect()->route('admin.careers.testimonials')->with('success', 'Testimonial updated successfully!');
    }

    public function destroyTestimonial(CareerTestimonial $testimonial)
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();
        $this->render();

        return redirect()->route('admin.careers.testimonials')->with('success', 'Testimonial deleted successfully!');
    }

    // Job Applications Management
    public function applications()
    {
        $applications = JobApplication::with('jobOpening')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.careers.applications', compact('applications'));
    }

    public function showApplication(JobApplication $application)
    {
        $application->load('jobOpening');

        return view('admin.careers.applications-show', compact('application'));
    }

    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,shortlisted,interviewed,offered,hired,rejected',
            'notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application status updated successfully!');
    }

    // Toggle Status Methods
    public function toggleBenefitStatus(CareerBenefit $benefit)
    {
        $benefit->update(['is_active' => ! $benefit->is_active]);

        return redirect()->back()->with('success', 'Benefit status updated successfully!');
    }

    public function toggleTestimonialStatus(CareerTestimonial $testimonial)
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);

        return redirect()->back()->with('success', 'Testimonial status updated successfully!');
    }

    public function toggleJobFeatured(JobOpening $job)
    {
        $job->update(['is_featured' => ! $job->is_featured]);

        return redirect()->back()->with('success', 'Job featured status updated successfully!');
    }

    public function render()
    {
        $careers = Career::active()->latest()->paginate(10);
        $benefits = CareerBenefit::active()->ordered()->get();
        $jobOpenings = JobOpening::active()->ordered()->get();
        $testimonials = CareerTestimonial::active()->ordered()->get();

        // Group job openings by category
        $jobsByCategory = $jobOpenings->groupBy('category');

        Helper::putCache('careers.benefits', view('admin.template.careers.benefits', compact('benefits'))->render());
        Helper::putCache('careers.testimonials', view('admin.template.careers.testimonials', compact('testimonials'))->render());
        Helper::putCache('careers.job_openings', view('admin.template.careers.job_openings', compact('jobOpenings', 'jobsByCategory'))->render());
    }
}
