<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Payment;
use App\Models\Subscription;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentsController extends Controller
{

    public function create(StripeClient $stripe , Subscription $subscription)
    {

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' =>$subscription->plan->name,
                        ],
                        'unit_amount' => $subscription->plan->price,
                    ],
                    'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at),
                ]
            ],
            'metadata' => [
                'subscription_id' => $subscription
            ],
            'mode' => 'payment',
            'success_url' => route('payments.success' , $subscription->id),
            'cancel_url' => route('payments.cancel' , $subscription->id )
        ]);

        Payment::forceCreate([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->plan->price,
            'currency_code' => 'usd',
            'payment_gateway' => 'stripe',
            'gateway_reference_id' => $checkout_session->id,
            'data' => $checkout_session,
        ]);

        return redirect()->away($checkout_session->url);
    }
    public function store(Request $request, Subscription $subscription)
    {

        $stripe = new StripeClient(config('services.stripe.secret_key'));

        try {
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $subscription->price * 100,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        } catch (Error $e) {
            return Response::json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function success()
    {
        return view('uploads.home', [
            'file' => new File(),
        ])->with('success' , 'Payment Completed Successfully');
    }

    public function cancel()
    {
    }
}
