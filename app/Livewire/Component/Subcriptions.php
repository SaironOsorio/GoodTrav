<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Subcription;

class Subcriptions extends Component
{

    public function render()
    {
        $subscriptions = Subcription::orderBy('price', 'asc')->get();

        return view('livewire.component.subcriptions', [
            'subscriptions' => $subscriptions
        ]);
    }

}
