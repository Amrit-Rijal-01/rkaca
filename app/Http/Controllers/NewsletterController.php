<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
            'subscription_type' => 'nullable|in:events,general,insights',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->email;
        $subscriptionType = $request->subscription_type ?? 'events';

        // Check if email already exists
        $existingSubscription = Newsletter::where('email', $email)
            ->where('subscription_type', $subscriptionType)
            ->first();

        if ($existingSubscription) {
            if ($existingSubscription->status === 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already subscribed to our newsletter.',
                ]);
            } else {
                // Reactivate subscription
                $existingSubscription->update([
                    'status' => 'active',
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back! Your subscription has been reactivated.',
                ]);
            }
        }

        // Create new subscription
        Newsletter::create([
            'email' => $email,
            'name' => $request->name,
            'subscription_type' => $subscriptionType,
            'status' => 'active',
            'subscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! You will receive our latest updates and event notifications.',
        ]);
    }

    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subscription_type' => 'nullable|in:events,general,insights',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $subscriptionType = $request->subscription_type ?? 'events';

        $subscription = Newsletter::where('email', $request->email)
            ->where('subscription_type', $subscriptionType)
            ->where('status', 'active')
            ->first();

        if (! $subscription) {
            return response()->json([
                'success' => false,
                'message' => 'No active subscription found for this email address.',
            ]);
        }

        $subscription->update([
            'status' => 'inactive',
            'unsubscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully unsubscribed from our newsletter.',
        ]);
    }
}
