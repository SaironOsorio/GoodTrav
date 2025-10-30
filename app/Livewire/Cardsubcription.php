<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Cardsubcription extends Component
{
    public $subscription;
    public $couponCode = '';
    public $appliedDiscount = null;

    public function mount()
    {
        $this->subscription = [
            [
                'type' => 'Membresía Mensual',
                'price' => '16',
                'stripe_price_id' => 'price_1SNfyw7ORTsDlR2jKYKPDrcL',
                'duration' => '1 Mes',
                'description' => 'Acceso completo a todas las lecciones y materiales de aprendizaje.',
                'features' => [
                    'Acceso ilimitado a lecciones',
                    'Material descargable',
                    'Certificado de finalización',
                    'Soporte prioritario',
                    'Actualizaciones mensuales',
                    'Comunidad exclusiva',
                ],
            ],
        ];
    }

    public function validateCoupon()
    {
        if (empty($this->couponCode)) {
            $this->appliedDiscount = null;
            session()->forget('coupon_error');
            session()->forget('coupon_success');
            return;
        }

        try {
            $stripe = new \Stripe\StripeClient(config('cashier.secret'));
            $coupon = $stripe->coupons->retrieve($this->couponCode);

            // Verificar si el cupón está activo
            if (!$coupon->valid) {
                session()->flash('coupon_error', 'Este cupón ya no es válido');
                $this->appliedDiscount = null;
                return;
            }

            // Calcular el descuento
            if ($coupon->percent_off) {
                $discount = $coupon->percent_off . '% de descuento';
                $newPrice = 16 * (1 - $coupon->percent_off / 100);
            } else {
                $discount = '€' . ($coupon->amount_off / 100) . ' de descuento';
                $newPrice = 16 - ($coupon->amount_off / 100);
            }

            $this->appliedDiscount = [
                'description' => $discount,
                'new_price' => round($newPrice, 2),
                'original_price' => 16,
            ];

            session()->flash('coupon_success', '¡Cupón aplicado! ' . $discount);
            session()->forget('coupon_error');

        } catch (\Exception $e) {
            session()->flash('coupon_error', 'Cupón no válido. Verifica el código e intenta nuevamente.');
            $this->appliedDiscount = null;
            Log::error('Coupon validation error: ' . $e->getMessage());
        }
    }

    public function checkout($stripePriceId, $coupon = '')
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        $user = Auth::user();
        $hasHadTrial = $user->is_on_trial !== null;

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


            if (!$hasHadTrial) {
                $sessionParams['subscription_data'] = [
                    'trial_period_days' => 7,
                ];
                Log::info('Trial applied for user: ' . $user->id);
            }

            // Aplicar cupón si existe
            if (!empty($coupon)) {
                try {
                    $stripeCoupon = $stripe->coupons->retrieve($coupon);

                    if ($stripeCoupon->valid) {
                        $sessionParams['discounts'] = [
                            ['coupon' => $coupon]
                        ];
                        Log::info('Coupon applied: ' . $coupon);
                    } else {
                        session()->flash('coupon_error', 'Este cupón ya no es válido');
                        return;
                    }
                } catch (\Exception $e) {
                    session()->flash('coupon_error', 'Cupón inválido o expirado');
                    Log::error('Coupon error: ' . $e->getMessage());
                    return;
                }
            }

            $session = $stripe->checkout->sessions->create($sessionParams);

            return redirect($session->url);
        } catch (\Exception $e) {
            session()->flash('checkout_error', 'Error al procesar el pago: ' . $e->getMessage());
            Log::error('Stripe Checkout Error: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        $user = Auth::user();
        $hasHadTrial = $user ? $user->is_on_trial !== null : false;

        return view('livewire.cardsubcription', [
            'subscriptions' => $this->subscription,
            'hasHadTrial' => $hasHadTrial,
        ]);
    }
}
