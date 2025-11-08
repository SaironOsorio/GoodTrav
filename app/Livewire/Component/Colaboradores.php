<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Contributors;

class Colaboradores extends Component
{
    public $colaboradores;

    public function mount()
    {
        $this->colaboradores = Contributors::all();
    }

    public function render()
    {
        return view('livewire.component.colaboradores');
    }
}
