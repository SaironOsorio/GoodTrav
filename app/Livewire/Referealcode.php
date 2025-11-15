<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Society as SocietyModel;

class Referealcode extends Component
{
    public $referralCode;

    public function mount()
    {
        $user = Auth::user();
        $this->referralCode = $user ? $user->referral_code : '';
    }

    public function applyReferralCode()
    {

        if (empty($this->referralCode)) {
            session()->flash('error', __('Por favor ingresa un código de referido'));
            return;
        }

        $currentUser = Auth::user();
        /** @var User $currentUser */

        if ($currentUser->referral_code) {
            session()->flash('error', __('Ya has usado un código de referido anteriormente'));
            return;
        }


        $referrer = User::where('society_code', $this->referralCode)->first();

        if (!$referrer) {
            session()->flash('error', __('Código de referido no válido'));
            return;
        }


        if ($referrer->id === $currentUser->id) {
            session()->flash('error', __('No puedes usar tu propio código de referido'));
            return;
        }


        $society = SocietyModel::where('user_id', $referrer->id)->first();
        if ($society) {
            $society->increment('user_count');
        }

        $currentUser->gt_points += 500;


        $currentUser->referral_code = $this->referralCode;
        $currentUser->save();


        $referrer->gt_points += 500;
        $referrer->save();

        session()->flash('message', __('¡Código aplicado exitosamente! Has ganado 500 puntos'));

        $this->referralCode = '';
        $this->mount();
    }
    public function render()
    {
        return view('livewire.referealcode');
    }
}
