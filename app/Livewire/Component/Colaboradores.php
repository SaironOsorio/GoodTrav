<?php

namespace App\Livewire\Component;

use Livewire\Component;

class Colaboradores extends Component
{
    public $colaboradores = [
        [
            'imagen' => 'https://i.pinimg.com/736x/b0/cd/62/b0cd626f82ac93db430dfa31b345e206.jpg',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ],
        [
            'imagen' => 'https://i.pinimg.com/736x/b0/cd/62/b0cd626f82ac93db430dfa31b345e206.jpg',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ],
        [
            'imagen' => 'https://i.pinimg.com/736x/b0/cd/62/b0cd626f82ac93db430dfa31b345e206.jpg',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ],
        [
            'imagen' => 'https://i.pinimg.com/736x/b0/cd/62/b0cd626f82ac93db430dfa31b345e206.jpg',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ],      
    ];

    public function mount()
    {
        $this->colaboradores = $this->colaboradores;
    }

    public function render()
    {
        return view('livewire.component.colaboradores');
    }
}
