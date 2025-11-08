<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TripController;

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

Route::get('Cookies', function(){
    return view('cookies');
})
->name('cookies');

Route::get('PoliticasPrivacidad', function(){
    return view('privacity');
})
->name('privacity');

Route::get('Legal', function(){
    return view('legal');
})
->name('legal');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('dashboard');
Route::view('study', 'study')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('study');
Route::view('points', 'points')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('points');
Route::view('trips', 'trips')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('trips');
Route::view('forum', 'forum')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('forum');
Route::view('society', 'Society')
    ->middleware(['auth', 'verified', 'check.subscription'])
    ->name('society');
Route::get('/trip/{trip:slug}', [TripController::class, 'show'])
    ->name('trip.detail');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/billing', 'settings.billing-fac')->name('billing');

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
