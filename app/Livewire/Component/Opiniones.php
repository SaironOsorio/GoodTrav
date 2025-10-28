<?php

namespace App\Livewire\Component;

use Livewire\Component;

class Opiniones extends Component
{
    public $opiniones = [
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
        [
            'nombre' => 'Bonnie Green',
            'opinion' => '“Mi hija está muy ilusionada por seguir mejorando, y eso para mí es maravilloso. Lo recomiendo al 100%.”',
        ],
    ];

    public function mount()
    {
        $this->opiniones = $this->opiniones;
    }

    public function render()
    {
        return view('livewire.component.opiniones');
    }
}
