<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInformation::getActive();
        $footer_setting = \App\Models\FooterSetting::getInstance();

        return view('contact', compact('contactInfo', 'footer_setting'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255|min:2',
                'last_name' => 'required|string|max:255|min:2',
                'email' => 'required|email|max:255',
                'phone' => [
                    'nullable',
                    'string',
                    'max:20',
                    'regex:/^(\+?977[-\s]?)?(\d{2}[-\s]?\d{7,8}|\d{9,10}|01[-\s]?\d{6,7})$/',
                    'required',
                ],
                'company' => 'nullable|string|max:255',
                'service' => 'nullable|string|max:255',
                'message' => 'required|string|min:10|max:2000',
                'privacy_consent' => 'required|accepted',
            ], [
                'first_name.required' => 'First name is required.',
                'first_name.min' => 'First name must be at least 2 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.min' => 'Last name must be at least 2 characters.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'phone.regex' => 'Please enter a valid phone number. Supported formats: +977-98XXXXXXXX, 98XXXXXXXX, 01-XXXXXXX, or international format.',
                'message.required' => 'Message is required.',
                'message.min' => 'Message must be at least 10 characters.',
                'message.max' => 'Message cannot exceed 2000 characters.',
                'privacy_consent.required' => 'You must agree to the privacy policy.',
                'privacy_consent.accepted' => 'You must agree to the privacy policy.',
            ]);

            // Combine first and last name
            $name = $request->first_name.' '.$request->last_name;

            Contact::create([
                'name' => $name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->service ?? 'General Inquiry',
                'message' => $request->message,
                'status' => 'new',
            ]);

            return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Please check the form for errors and try again.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
