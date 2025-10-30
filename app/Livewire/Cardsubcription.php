<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Cardsubcription extends Component
{
    public $subscription;
    public $couponCode = '';

    public function mount()
    {
        $this->subscription = [
            [
                'type' => 'Basic',
                'price' => '16 EUR',
                'stripe_price_id' => 'price_1SNfyw7ORTsDlR2jKYKPDrcL',
                'duration' => '1 Month',
                'features' => [
                    'Access to basic features',
                    'Email support',
                    'Single user license',
                ],
            ],
        ];
    }

    public function checkout($stripePriceId, $coupon = '')
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            $stripe = new \Stripe\StripeClient(config('cashier.secret'));

            $sessionParams = [
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $stripePriceId,
                        'quantity' => 1,
                    ],
                ],
                'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('subscription'),
                'customer_email' => Auth::user()->email,
                'metadata' => [
                    'user_id' => Auth::id(),
                ],
            ];

            // Si hay cupón, intentar aplicarlo
            if (!empty($coupon)) {
                try {
                    $stripeCoupon = $stripe->coupons->retrieve($coupon);
                    $sessionParams['discounts'] = [
                        ['coupon' => $coupon]
                    ];
                } catch (\Exception $e) {
                    session()->flash('coupon_error', 'Cupón inválido o expirado');
                    return;
                }
            }

            $session = $stripe->checkout->sessions->create($sessionParams);

            return redirect($session->url);
        } catch (\Exception $e) {
            session()->flash('checkout_error', 'Error: ' . $e->getMessage());
            Log::error('Stripe Checkout Error: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.cardsubcription', [
            'subscriptions' => $this->subscription,
        ]);
    }
}
