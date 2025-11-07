<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Trip;


class Detailtrip extends Component
{
    public $trip;


    public function mount(Trip $tripData)
    {
        $this->trip = $tripData;
    }


    public function render()
    {
        return view('livewire.detailtrip');
    }
}
