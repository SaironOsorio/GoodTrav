<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use Carbon\Carbon;

class WeeklyClassCard extends Component
{
    public $study;
    public $title;
    public $startDate;
    public $endDate;
    public $formattedDateRange;
    public $image;
    public $points;

    public function mount()
    {
        $this->getInformationClass();
    }

    private function getInformationClass()
    {
        $this->study = Study::with('challenges')->first();

        if ($this->study) {
            $this->title = $this->study->title;
            $this->image = $this->study->image;
            $this->points = $this->study->points;


            Carbon::setLocale('es');
            $start = Carbon::parse($this->study->start_date ?? now());
            $end = Carbon::parse($this->study->end_date ?? now());

            $this->startDate = $start;
            $this->endDate = $end;
            $this->formattedDateRange = ucfirst($start->isoFormat('ddd D MMM, HH:mm')) . ' - ' . ucfirst($end->isoFormat('ddd D MMM, HH:mm'));

        }
    }

    public function render()
    {
        return view('livewire.weekly-class-card');
    }
}
