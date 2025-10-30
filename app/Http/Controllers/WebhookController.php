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
            $subscriptionId = $data['subscription'] ?? null;

            if ($subscriptionId) {
                try {
                    $stripe = new \Stripe\StripeClient(config('cashier.secret'));
                    $stripeSubscription = $stripe->subscriptions->retrieve($subscriptionId);

                    $trialEnd = $stripeSubscription->trial_end ?? null;

                    $user->stripe_id = $data['customer'] ?? null;
                    $user->stripe_subscription_id = $subscriptionId;
                    $user->subscription_start_date = now();

                    if ($trialEnd) {
                        // Usuario en trial - la fecha de fin es cuando termina el trial
                        $user->subscription_end_date = \Carbon\Carbon::createFromTimestamp($trialEnd);
                        $user->is_on_trial = true;

                        Log::info('✅ Trial started', [
                            'user_id' => $user->id,
                            'email' => $user->email,
                            'trial_end' => $user->subscription_end_date->format('Y-m-d H:i:s'),
                        ]);
                    } else {
                        // Suscripción normal sin trial
                        $user->subscription_end_date = now()->addMonth();
                        $user->is_on_trial = false;

                        Log::info('✅ Subscription activated (no trial)', [
                            'user_id' => $user->id,
                            'email' => $user->email,
                            'end_date' => $user->subscription_end_date->format('Y-m-d'),
                        ]);
                    }

                    $user->gt_points = 0;
                    $user->save();

                } catch (\Exception $e) {
                    Log::error('Error retrieving subscription: ' . $e->getMessage());

                    // Fallback: asumir 1 mes si no podemos obtener la info del trial
                    $user->subscription_start_date = now();
                    $user->subscription_end_date = now()->addMonth();
                    $user->gt_points = 0;
                    $user->stripe_id = $data['customer'] ?? null;
                    $user->save();
                }
            } else {
                // No hay subscription ID en el payload
                $user->subscription_start_date = now();
                $user->subscription_end_date = now()->addMonth();
                $user->gt_points = 0;
                $user->stripe_id = $data['customer'] ?? null;
                $user->save();
            }
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
                $trialEnd = $data['trial_end'] ?? null;

                if ($trialEnd) {
                    // Tiene trial
                    $user->subscription_end_date = \Carbon\Carbon::createFromTimestamp($trialEnd);
                    $user->is_on_trial = true;

                    Log::info('✅ Trial dates updated', [
                        'user_id' => $user->id,
                        'trial_end' => $user->subscription_end_date->format('Y-m-d H:i:s'),
                    ]);
                } else {
                    // Sin trial
                    $user->subscription_end_date = now()->addMonth();
                    $user->is_on_trial = false;

                    Log::info('✅ Subscription dates updated', [
                        'user_id' => $user->id,
                        'end_date' => $user->subscription_end_date->format('Y-m-d'),
                    ]);
                }

                $user->save();
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
        $billingReason = $data['billing_reason'] ?? null;

        Log::info('Billing reason: ' . $billingReason);

        if ($stripeId) {
            $user = User::where('stripe_id', $stripeId)->first();

            if ($user) {
                if ($billingReason === 'subscription_cycle') {
                    if ($user->subscription_end_date && $user->subscription_end_date->isFuture()) {
                        $user->subscription_end_date = $user->subscription_end_date->copy()->addMonth();
                        Log::info('✅ Subscription renewed from: ' . $user->subscription_end_date->copy()->subMonth()->format('Y-m-d') . ' to: ' . $user->subscription_end_date->format('Y-m-d'));
                    } else {
                        $user->subscription_end_date = now()->addMonth();
                        Log::info('✅ Subscription renewed from now (was expired): ' . $user->subscription_end_date->format('Y-m-d'));
                    }

                    if ($user->is_on_trial) {
                        $user->is_on_trial = false;
                        Log::info('✅ Trial ended, user is now paying subscriber');
                    }

                    $user->save();

                    Log::info('User subscription updated', [
                        'user_id' => $user->id,
                        'billing_reason' => $billingReason,
                        'is_on_trial' => $user->is_on_trial,
                        'subscription_end_date' => $user->subscription_end_date->format('Y-m-d H:i:s')
                    ]);
                } else if ($billingReason === 'subscription_create') {

                    Log::info('ℹ️ Initial subscription payment, dates already set in checkout.session.completed');


                    if ($user->is_on_trial && $user->subscription_end_date && $user->subscription_end_date->isPast()) {
                        $user->is_on_trial = false;
                        $user->save();
                        Log::info('✅ Trial ended (was in the past)');
                    }
                }
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
                $user->is_on_trial = false;
                $user->save();

                Log::info('❌ Subscription canceled for user: ' . $user->id);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
