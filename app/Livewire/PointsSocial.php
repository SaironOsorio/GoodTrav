<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Socialmedia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PointsSocial extends Component
{
    public $tiktok = 'goodtrap';
    public $instagram = 'goodtrap';
    public $isInstagramClaimed = false;
    public $isTiktokClaimed = false;

    public function mount(): void
    {
        $social = Socialmedia::first();
        $this->tiktok = trim($social?->tiktok ?? 'goodtrap');
        $this->instagram = trim($social?->instagram ?? 'goodtrap');

        if (Auth::check()) {
            $this->isInstagramClaimed = (bool) (Auth::user()->is_instagram ?? false);
            $this->isTiktokClaimed = (bool) (Auth::user()->is_tiktok ?? false);
        }
    }

    public function claimInstagramPoints(): void
    {
        if (! $this->isInstagramClaimed && Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $user->update([
                'is_instagram' => true,
                'gt_points' => ($user->gt_points ?? 0) + 500,
            ]);
            $this->isInstagramClaimed = true;
            session()->flash('success', '¡+500 puntos ganados por Instagram!');
            $this->dispatch('points-updated');
        }
    }

    public function claimTiktokPoints(): void
    {
        if (! $this->isTiktokClaimed && Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $user->update([
                'is_tiktok' => true,
                'gt_points' => ($user->gt_points ?? 0) + 500,
            ]);
            $this->isTiktokClaimed = true;
            session()->flash('success', '¡+500 puntos ganados por TikTok!');
            $this->dispatch('points-updated');
        }
    }


    public function render()
    {
        return view('livewire.points-social');
    }
}
