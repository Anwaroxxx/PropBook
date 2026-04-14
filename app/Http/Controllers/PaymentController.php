<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.sk'));
    }

    /**
     * Create a Stripe checkout session for a visit.
     */
    public function createCheckoutSession(Request $request, Visit $visit)
    {
        // Check ownership
        if ($visit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Only allow pending visits to be paid
        if (!$visit->isPending()) {
            return response()->json(['error' => 'Visit is not pending'], 400);
        }

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'mad',
                            'product_data' => [
                                'name' => 'Property Visit - ' . $visit->property->title,
                                'description' => $visit->start_time->format('Y-m-d H:i') . ' to ' . $visit->end_time->format('H:i'),
                            ],
                            'unit_amount' => (int)($visit->property->price_per_visit * 100),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => url('/payment/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/payment/cancel'),
            ]);

            // Store session ID in visit
            $visit->update(['stripe_session_id' => $checkoutSession->id]);

            return response()->json([
                'session_id' => $checkoutSession->id,
                'checkout_url' => $checkoutSession->url,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe session creation failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to create checkout session',
            ], 500);
        }
    }

    /**
     * Handle successful payment.
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('calendar')->with('error', 'Missing session ID');
        }

        try {
            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $visit = Visit::where('stripe_session_id', $sessionId)->first();

                if ($visit) {
                    $visit->update(['status' => 'confirmed']);

                    return view('payment.success', ['visit' => $visit]);
                }
            }

            return redirect()->route('calendar')->with('error', 'Invalid session or payment not completed');
        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage());

            return redirect()->route('calendar')->with('error', 'Failed to verify payment');
        }
    }

    /**
     * Handle cancelled payment.
     */
    public function paymentCancel()
    {
        return view('payment.cancel');
    }
}
