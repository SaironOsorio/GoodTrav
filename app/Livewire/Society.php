<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Society as SocietyModel;

class Society extends Component
{
    public $isSocietyMember;
    public $referralCode;

    public function mount()
    {
        $user = Auth::user();
        $this->isSocietyMember = $user ? $user->is_society : false;
    }

    public function joinSociety()
    {
        $user = Auth::user();
        /** @var User $user */

        if ($user && !$this->isSocietyMember && !$user->society_code) {
            $user->is_society = true;
            $user->society_code = 'gt-'. Str::random(4);
            $user->save();
            $this->isSocietyMember = true;
            SocietyModel::create([
                'user_id' => $user->id,
                'user_count' => 0,
            ]);
        }
        $this->mount();
    }

    public function leaveSociety()
    {
        $user = Auth::user();
        /** @var User $user */

        if ($user && $this->isSocietyMember) {
            $user->is_society = false;
            $user->society_code = null;
            $user->save();
            $this->isSocietyMember = false;
            $society = SocietyModel::where('user_id', $user->id)->first();
            if ($society) {
                $society->delete();
            }
        }
        $this->mount();
    }

    public function copyCode()
    {
        $code = Auth::user()->society_code;
        $this->dispatch('code-copied', code: $code);

        session()->flash('message', __('Código copiado al portapapeles'));
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

        $currentUser->increment('gt_points', 500);


        $currentUser->referral_code = $this->referralCode;
        $currentUser->save();


        $referrer->increment('gt_points', 500);

        session()->flash('message', __('¡Código aplicado exitosamente! Has ganado 500 puntos'));

        $this->referralCode = '';
        $this->mount();
    }

    public function render()
    {
        return view('livewire.society');
    }
}
