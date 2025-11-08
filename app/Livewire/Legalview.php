<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\legal;

class Legalview extends Component
{
    public $legal;

    public function mount()
    {
        $this->legal = legal::all();
    }
    
    public function render()
    {
        return view('livewire.legalview');
    }
}
