<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureHaveActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Check if the user has an active subscription
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('plans'); // Redirect to subscription plans page
        }

        // Check if the user has a completed payment
        if (!$user->hasCompletedPayment()) {
            return response('the payment process failed' , 200);
        }
        return $next($request);
    }
}
