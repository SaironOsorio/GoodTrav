<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reserver;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class Tripinfo extends Component
{
    public $reserver;
    public $trips;
    public $userAgeCategory;

    public function mount()
    {
        $this->LoadReservedUser();
        $this->LoadTrip();
        $this->userAgeCategory = $this->getUserAgeCategory();
    }

    private function LoadReservedUser()
    {
        $this->reserver = Reserver::where('user_id', Auth::id())->get();
    }

    private function LoadTrip()
    {
        $this->trips = Trip::all();
    }

    public function getUserAgeCategory()
    {
        if (!Auth::user()->date_of_birth) {
            return 'Sin categoría';
        }

        $age = \Carbon\Carbon::parse(Auth::user()->date_of_birth)->age;

        if ($age >= 11 && $age <= 14) {
            return 'Junior';
        } elseif ($age >= 15) {
            return 'Senior';
        } else {
            return 'Niño';
        }
    }

    public function accessTrip($slug)
    {
        $this->redirect(route('trip.detail', ['trip' => $slug]), navigate: true);
    }


    public function render()
    {
        return view('livewire.tripinfo');
    }
}
