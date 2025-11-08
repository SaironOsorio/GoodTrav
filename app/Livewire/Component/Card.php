<?php
namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Trip;

class Card extends Component
{
    public $mostrarTodas = false;
    public $cardsAMostrar = 3;

    public function mostrarMasOmenos()
    {
        $this->mostrarTodas = !$this->mostrarTodas;
    }

    public function render()
    {
        $trips = Trip::all();

        $cardsARenderizar = $this->mostrarTodas
            ? $trips
            : $trips->take($this->cardsAMostrar);

        return view('livewire.component.card', [
            'card' => $cardsARenderizar,
            'mostrarTodas' => $this->mostrarTodas,
            'tieneMasCards' => $trips->count() > $this->cardsAMostrar,
        ]);
    }
}
