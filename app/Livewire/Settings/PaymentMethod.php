<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;

class PaymentMethod extends Component
{
    public $clientSecret;
    public $paymentMethods = [];
    public $hasDefaultPaymentMethod = false;
    private $stripe;

    public function mount()
    {
        try {
            $this->stripe = new StripeClient(config('cashier.secret'));
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user->stripe_id) {
                $customer = $this->stripe->customers->create([
                    'email' => $user->email,
                    'name' => $user->name,
                ]);
                $user->stripe_id = $customer->id;
                $user->save();
            }


            $this->createNewSetupIntent();


            $this->loadPaymentMethods();

        } catch (\Exception $e) {
            Log::error('Error in PaymentMethod mount: ' . $e->getMessage());
            session()->flash('payment-error', 'Error al cargar métodos de pago: ' . $e->getMessage());
        }
    }

    private function createNewSetupIntent()
    {
        try {
            if (!$this->stripe) {
                $this->stripe = new StripeClient(config('cashier.secret'));
            }

            $user = Auth::user();

            $setupIntent = $this->stripe->setupIntents->create([
                'customer' => $user->stripe_id,
            ]);

            $this->clientSecret = $setupIntent->client_secret;

            Log::info('Nuevo SetupIntent creado: ' . $setupIntent->id);

        } catch (\Exception $e) {
            Log::error('Error creating setup intent: ' . $e->getMessage());
        }
    }

    public function loadPaymentMethods()
    {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user->stripe_id) {
                return;
            }

            if (!$this->stripe) {
                $this->stripe = new StripeClient(config('cashier.secret'));
            }


            $customer = $this->stripe->customers->retrieve($user->stripe_id);
            $defaultPaymentMethodId = $customer->invoice_settings->default_payment_method ?? null;


            $paymentMethods = $this->stripe->paymentMethods->all([
                'customer' => $user->stripe_id,
                'type' => 'card',
            ]);

            $this->paymentMethods = collect($paymentMethods->data)->map(function ($pm) use ($defaultPaymentMethodId) {
                return [
                    'id' => $pm->id,
                    'brand' => $pm->card->brand,
                    'last4' => $pm->card->last4,
                    'exp_month' => $pm->card->exp_month,
                    'exp_year' => $pm->card->exp_year,
                    'is_default' => $pm->id === $defaultPaymentMethodId,
                ];
            })->toArray();

            $this->hasDefaultPaymentMethod = !empty($defaultPaymentMethodId);

        } catch (\Exception $e) {
            Log::error('Error loading payment methods: ' . $e->getMessage());
            $this->paymentMethods = [];
        }
    }

    public function addPaymentMethod($paymentMethodId)
    {
        try {
            if (!$this->stripe) {
                $this->stripe = new StripeClient(config('cashier.secret'));
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();


            $this->stripe->paymentMethods->attach($paymentMethodId, [
                'customer' => $user->stripe_id,
            ]);

            $customer = $this->stripe->customers->retrieve($user->stripe_id);
            if (empty($customer->invoice_settings->default_payment_method)) {
                $this->stripe->customers->update($user->stripe_id, [
                    'invoice_settings' => [
                        'default_payment_method' => $paymentMethodId,
                    ],
                ]);
            }


            $this->loadPaymentMethods();


            $this->createNewSetupIntent();

            session()->flash('payment-updated', '¡Tarjeta agregada correctamente!');

            $this->dispatch('payment-method-added', clientSecret: $this->clientSecret);

        } catch (\Exception $e) {
            Log::error('Error adding payment method: ' . $e->getMessage());
            session()->flash('payment-error', 'Error: ' . $e->getMessage());
        }
    }

    public function setDefaultPaymentMethod($paymentMethodId)
    {
        try {
            if (!$this->stripe) {
                $this->stripe = new StripeClient(config('cashier.secret'));
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();

            $this->stripe->customers->update($user->stripe_id, [
                'invoice_settings' => [
                    'default_payment_method' => $paymentMethodId,
                ],
            ]);

            $this->loadPaymentMethods();

            session()->flash('payment-updated', 'Tarjeta predeterminada actualizada.');

        } catch (\Exception $e) {
            Log::error('Error setting default payment method: ' . $e->getMessage());
            session()->flash('payment-error', 'Error: ' . $e->getMessage());
        }
    }

    public function deletePaymentMethod($paymentMethodId)
    {
        try {
            if (!$this->stripe) {
                $this->stripe = new StripeClient(config('cashier.secret'));
            }

            $this->stripe->paymentMethods->detach($paymentMethodId);

            $this->loadPaymentMethods();

            session()->flash('payment-updated', 'Tarjeta eliminada correctamente.');

        } catch (\Exception $e) {
            Log::error('Error deleting payment method: ' . $e->getMessage());
            session()->flash('payment-error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.settings.payment-method');
    }
}
