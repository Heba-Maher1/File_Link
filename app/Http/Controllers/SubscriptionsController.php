<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user has an active subscription
        if ($user->hasActiveSubscription()) {
            return redirect()->route('alreadySubscribe');
        }
        
        $request->validate([
            'plan_id' => ['required', 'int'],
        ]);

        $plan = Plan::findOrFail($request->post('plan_id'));

        $months = $request->post('period');

        $subscription = Subscription::create([
            'plan_id' => $plan->id,
            'user_id' => $request->user()->id,
            'price' => $plan->price * $months,
            'expires_at' => now()->addMonths($months),
            'status' => 'pending',
        ]);

        return redirect()->route('checkout' , $subscription->id);
    }
}
