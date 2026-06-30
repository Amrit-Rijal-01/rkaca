<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    public function index()
    {
        $carrers = DB::table('careers')->where('status', 'active')->get();
        $carrer_benefits = DB::table('career_benefits')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        $carrer_testimonials = DB::table('career_testimonials')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        $job_openings = DB::table('job_openings')->where('status', 'active')->orderBy('sort_order', 'desc')->get();
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'careers')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('new.carrers', [
            'carrers' => $carrers,
            'carrer_benefits' => $carrer_benefits,
            'carrer_testimonials' => $carrer_testimonials,
            'job_openings' => $job_openings,
            'jumbotrons' => $jumbotrons,
        ]);
    }

    public function apply(Request $request)
    {
        // $request->validate([
        //     'job_id' => 'required|exists:job_openings,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|string|max:20',
        //     'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        // ]);

        // Handle file upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            return back()->withErrors(['resume' => 'Resume upload failed.'])->withInput();
        }

        $job_data = new JobApplication;
        $job_data->job_opening_id = $request->job_id;
        $job_data->first_name = $request->first_name;
        $job_data->last_name = $request->last_name;
        $job_data->email = $request->email;
        $job_data->phone = $request->phone;
        $job_data->resume_path = $resumePath;
        if ($request->has('cover_letter')) {
            $job_data->cover_letter = $request->cover_letter;
        }
        if ($request->has('portfolio')) {
            $job_data->portfolio_url = $request->portfolio;
        }
        if ($request->has('linkedin')) {
            $job_data->linkedin_profile = $request->linkedin;
        }
        if ($request->has('expected_salary')) {
            $job_data->expected_salary = $request->expected_salary;
        }
        if ($request->has('start_date')) {
            $job_data->available_start_date = $request->start_date;
        }
        $job_data->save();

        return back()->with('success', 'Your application has been submitted successfully!');
    }
}
