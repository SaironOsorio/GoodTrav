<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\legal;

class Termspage extends Component
{
    public $privacy;

    public function mount()
    {
        $this->privacy = legal::all();
    }
    public function render()
    {
        return view('livewire.termspage');
    }
}
