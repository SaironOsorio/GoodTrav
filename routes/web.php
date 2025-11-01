<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**Route Subscription */
Route::get('subscription', function () {
    return view('viewsubscription.subcription');
})->middleware(['auth', 'verified'])
->name('subscription');

Route::middleware(['auth'])->group(function () {
    Route::get('/subscription/success', function () {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if ($user) {
            $user->refresh(); // Refrescar datos del usuario
        }
        return view('viewsubscription.success');
    })->name('subscription.success');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('dashboard');
Route::view('study', 'study')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('study');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
