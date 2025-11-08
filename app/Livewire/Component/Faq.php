<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Questions;

class Faq extends Component
{
    public $questions;

    public function mount()
    {
        $this->questions = Questions::orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.component.faq');
    }
}