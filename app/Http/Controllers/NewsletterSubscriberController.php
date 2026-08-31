<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(['email' => $request->email]);

        if ($subscriber->wasRecentlyCreated) {
            return response()->json(['success' => true, 'message' => 'Thank you for subscribing!']);
        }

        return response()->json(['success' => true, 'message' => "You're already subscribed to our updates!"]);
    }
}
