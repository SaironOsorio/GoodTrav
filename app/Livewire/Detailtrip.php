<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Detailtrip extends Component
{
    public $trip;

    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $gts_member = null;     
    public $date_call = null;      
    public $terms = false;


    public function mount(Trip $tripData)
    {
        $this->trip = $tripData;

        if (Auth::check()) {
            $user = Auth::user();
            $this->full_name = $user->student_name ?? '';
            $this->email     = $user->email ?? '';
            $this->phone     = $user->phone ?? '';
        }
    }

    public function submitReservation()
    {

        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para reservar.');
            return;
        }

        $this->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|string|max:50',
            'gts_member'=> 'nullable|integer|min:0|max:100',
            'date_call' => 'required|date|after:now',
            'terms'     => 'accepted',
        ]);

        try {
            DB::beginTransaction();


            $this->trip->refresh();

            if ($this->trip->plazas_available <= 0) {
                session()->flash('error', 'Lo sentimos, ya no quedan plazas disponibles para este viaje.');
                DB::rollBack();
                return;
            }

            $existingReservation = Reserver::where('user_id', Auth::id())
                ->where('trip_id', $this->trip->id)
                ->whereNotIn('status', ['canceled', 'cancelled'])
                ->exists();

            if ($existingReservation) {
                session()->flash('error', 'Ya tienes una reserva para este viaje.');
                DB::rollBack();
                return;
            }


            Reserver::create([
                'user_id'        => Auth::id(),
                'trip_id'        => $this->trip->id,
                'name_trip'      => $this->trip->title,
                'date_trip'      => $this->trip->start_date,
                'total_points'   => $this->trip->points,
                'total_price'    => $this->trip->price,
                'discount'       => $this->gts_member,
                'status'         => 'pending',
                'phone_called_at'=> $this->date_call,
            ]);


            $this->trip->decrement('plazas_available');

            DB::commit();


            $this->dispatch('reservation-saved');
        
            $this->reset(['gts_member', 'date_call', 'terms']);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Ocurrió un error al procesar tu solicitud. Por favor, intenta nuevamente.');
            Log::error('Error al crear reserva: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.detailtrip');
    }
}
