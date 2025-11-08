<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\legal;

class Cookiesview extends Component
{
    public $cookies;

    public function mount()
    {
        $this->cookies = legal::all();
    }
    public function render()
    {
        return view('livewire.cookiesview');
    }
}
