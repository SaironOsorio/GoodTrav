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



    public function render()
    {
        return view('livewire.society');
    }
}
