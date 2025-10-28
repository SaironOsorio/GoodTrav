<?php

namespace App\Livewire\Component;

use Livewire\Component;

class Card extends Component
{
    public $cards = [
        [
            'title' => 'CIUDAD',
            'description' => 'Desde Bilbao 20-25 abril',
            'image' => 'https://img.andrewprokos.com/FLUX-PONTEM-8869-1000PX.jpg',
            'price' => 100,
        ],
        [
            'title' => 'CIUDAD',
            'description' => 'Desde Bilbao 20-25 abril',
            'image' => 'https://img.andrewprokos.com/FLUX-PONTEM-8869-1000PX.jpg',
            'price' => 100,
        ],
        [
            'title' => 'CIUDAD',
            'description' => 'Desde Bilbao 20-25 abril',
            'image' => 'https://img.andrewprokos.com/FLUX-PONTEM-8869-1000PX.jpg',
            'price' => 100,
        ],
        [
            'title' => 'CIUDAD',
            'description' => 'Desde Bilbao 20-25 abril',
            'image' => 'https://img.andrewprokos.com/FLUX-PONTEM-8869-1000PX.jpg',
            'price' => 100,
        ],
    ];

    public $var = [];
    public $mostrarTodas = false;
    public $cardsAMostrar = 3;

    public function mount()
    {
        $this->var = $this->cards;
    }

    public function mostrarMasOmenos()
    {
        if ($this->mostrarTodas) {
            $this->mostrarTodas = false;
        } else {
            $this->mostrarTodas = true;
        }
        $this->dispatch('mostrarMasOmenos');
    }

    public function render()
    {
        $cardsARenderizar = $this->mostrarTodas ? $this->var : array_slice($this->var, 0, $this->cardsAMostrar);
        
        return view('livewire.component.card', [
            'card' => $cardsARenderizar,
            'mostrarTodas' => $this->mostrarTodas,
            'tieneMasCards' => count($this->var) > $this->cardsAMostrar,
        ]);
    }
}
