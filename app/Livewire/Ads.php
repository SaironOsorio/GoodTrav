<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modal;

class Ads extends Component
{
    public $content;

    public function mount()
    {

        $this->content = Modal::where('is_active', true)
            ->latest()
            ->first();
    }

    public function render()
    {
        return view('livewire.ads');
    }
}