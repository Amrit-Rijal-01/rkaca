<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInformation::getActive();
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'contact')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        $footer_setting = \App\Models\FooterSetting::getInstance();

        return view('new.contact', compact('contactInfo', 'jumbotrons', 'footer_setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_interest' => 'nullable|string|max:255',
            'message' => 'required|string',
            'privacy_consent' => 'required|accepted',
        ]);

        // Combine first and last name
        $name = $request->first_name.' '.$request->last_name;

        Contact::create([
            'name' => $name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->service_interest ?? 'General Inquiry',
            'message' => $request->message,
            'status' => 'new',
        ]);

        return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
