<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Handle a Stripe webhook call.
     */
    public function handleWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $type = $payload['type'] ?? 'unknown';

        // Solo logear eventos importantes
        $importantEvents = [
            'checkout.session.completed',
            'customer.subscription.created',
            'invoice.payment_succeeded',
            'customer.subscription.deleted',
            'invoice.payment_failed'
        ];

        if (in_array($type, $importantEvents)) {
            Log::info('=== WEBHOOK RECEIVED ===');
            Log::info('Webhook type: ' . $type);
        }

        // Manejar diferentes tipos de eventos
        switch ($type) {
            case 'checkout.session.completed':
                return $this->handleCheckoutSessionCompleted($payload);

            case 'customer.subscription.created':
                return $this->handleCustomerSubscriptionCreated($payload);

            case 'invoice.payment_succeeded':
                return $this->handleInvoicePaymentSucceeded($payload);

            case 'customer.subscription.deleted':
                return $this->handleSubscriptionCanceled($payload);

            default:
                // Responder 200 sin logear
                return response()->json(['status' => 'success']);
        }
    }

    /**
     * Handle checkout session completed.
     */
    protected function handleCheckoutSessionCompleted($payload)
    {
        Log::info('=== CHECKOUT SESSION COMPLETED ===');

        $data = $payload['data']['object'];
        $email = $data['customer_email'] ?? null;

        if (!$email) {
            Log::error('No customer email in payload');
            return response()->json(['status' => 'error', 'message' => 'No email']);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->subscription_start_date = now();
            $user->subscription_end_date = now()->addMonth();
            $user->gt_points = 0;
            $user->stripe_id = $data['customer'] ?? null;
            $user->save();

            Log::info('✅ Subscription activated', [
                'user_id' => $user->id,
                'email' => $user->email,
                'point_balance' => $user->gt_points,
                'end_date' => $user->subscription_end_date->format('Y-m-d'),
            ]);
        } else {
            Log::error('❌ USER NOT FOUND: ' . $email);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle customer subscription created.
     */
    protected function handleCustomerSubscriptionCreated($payload)
    {
        Log::info('=== CUSTOMER SUBSCRIPTION CREATED ===');

        $data = $payload['data']['object'];
        $stripeId = $data['customer'] ?? null;

        if ($stripeId) {
            $user = User::where('stripe_id', $stripeId)->first();

            if ($user) {
                $user->subscription_start_date = now();
                $user->subscription_end_date = now()->addMonth();
                $user->save();

                Log::info('✅ Subscription dates updated for user: ' . $user->id);
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle invoice payment succeeded.
     */
    protected function handleInvoicePaymentSucceeded($payload)
    {
        Log::info('=== INVOICE PAYMENT SUCCEEDED ===');

        $data = $payload['data']['object'];
        $stripeId = $data['customer'] ?? null;

        if ($stripeId) {
            $user = User::where('stripe_id', $stripeId)->first();

            if ($user) {
                // Renovar suscripción por un mes más
                $user->subscription_end_date = now()->addMonth();
                $user->save();

                Log::info('✅ Subscription renewed until: ' . $user->subscription_end_date->format('Y-m-d'));
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle subscription canceled.
     */
    protected function handleSubscriptionCanceled($payload)
    {
        Log::info('=== SUBSCRIPTION CANCELED ===');

        $data = $payload['data']['object'];
        $stripeId = $data['customer'] ?? null;

        if ($stripeId) {
            $user = User::where('stripe_id', $stripeId)->first();

            if ($user) {
                // Opcional: puedes dejar que expire naturalmente o cancelar inmediatamente
                $user->subscription_end_date = now(); // Cancelar inmediatamente
                $user->save();

                Log::info('❌ Subscription canceled for user: ' . $user->id);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
