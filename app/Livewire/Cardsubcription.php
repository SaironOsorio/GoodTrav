<?php

namespace App\Livewire;

use Livewire\Component;

class Cardsubcription extends Component
{
    public $subscription;

    public function mount()
    {
        $this->subscription = [
            [
                'type' => 'Basic',
                'price' => '9.99',
                'duration' => '1 Month',
                'features' => [
                    'Access to basic features',
                    'Email support',
                    'Single user license',
                ],
            ],
            [
                'type' => 'Premium',
                'price' => '19.99',
                'duration' => '1 Month',
                'features' => [
                    'Access to all features',
                    'Priority email support',
                    'Multi-user license',
                    'Advanced analytics',
                ],
            ],
            [
                'type' => 'Annual',
                'price' => '99.99',
                'duration' => '12 Months',
                'features' => [
                    'Access to all features',
                    'Priority email support',
                    'Multi-user license',
                    'Advanced analytics',
                    '2 months free compared to monthly plan',
                ],
            ],
        ];
    }
    public function render()
    {
        return view('livewire.cardsubcription', [
            'subscriptions' => $this->subscription,
        ]);
    }
}
