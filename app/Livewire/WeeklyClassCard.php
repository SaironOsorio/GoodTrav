<?php

namespace App\Livewire;

use Livewire\Component;

class WeeklyClassCard extends Component
{
    public $title = 'Clase semanal';
    public $schedule = 'Disponible de lunes 9:00 a domingo 23:59';
    public $videoType = 'Video (Vimeo)';
    public $classUrl = '#';
    
    public function render()
    {
        return view('livewire.weekly-class-card');
    }
}
