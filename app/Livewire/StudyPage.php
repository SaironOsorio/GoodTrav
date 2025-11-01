<?php

namespace App\Livewire;

use Livewire\Component;

class StudyPage extends Component
{
    public $activeTab = 'classes'; // 'classes' o 'challenges'

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function render()
    {
        return view('livewire.study-page');
    }
}
