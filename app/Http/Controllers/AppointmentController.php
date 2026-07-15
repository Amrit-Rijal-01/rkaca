<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentBooked;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'appointment_date' => 'required|date|after:now',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $appointment = Appointment::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'appointment_date' => Carbon::parse($request->appointment_date),
                'message' => $request->message,
                'status' => Appointment::STATUS_PENDING,
            ]);

            // Send email notification
            Mail::to(config('mail.from.address'))->send(new AppointmentBooked($appointment));

            return response()->json([
                'success' => true,
                'message' => 'Appointment scheduled successfully! We will contact you soon.',
                'data' => [
                    'id' => $appointment->id,
                    'appointment_date' => $appointment->appointment_date->format('M d, Y \a\t g:i A'),
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to schedule appointment. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        // For displaying appointments in admin panel
        $appointments = Appointment::latest()->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
}
