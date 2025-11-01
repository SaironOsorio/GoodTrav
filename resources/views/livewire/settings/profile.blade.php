<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $nationality = '';
    public string $country_code = '';
    public string $phone = '';
    public string $address = '';
    public string $date_of_birth = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->nationality = Auth::user()->country_id ?? '';
        $this->country_code = Auth::user()->country_code ?? '';
        $this->phone = Auth::user()->phone ?? '';
        $this->address = Auth::user()->address ?? '';
        $this->date_of_birth = Auth::user()->date_of_birth ?? '';

    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'nationality' => ['required', 'exists:countries,id'],
            'country_code' => ['required', 'string', 'max:5'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Perfil Usuario')" :subheading="__('Actualiza la información de perfil y la dirección de correo electrónico de tu cuenta.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Tu dirección de correo electrónico no está verificada.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Haz clic aquí para reenviar el correo electrónico de verificación.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            @php
                $countries = App\Models\Country::all();
            @endphp

            <!-- National -->
            <flux:select
                wire:model="nationality"
                name="country_id"
                :label="__('Nacionalidad')"
                required
                autocomplete="nationality"
            >
                <option value="">{{ __('Seleccione su nacionalidad') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </flux:select>

            <!-- Phone Number -->
            <div class="flex gap-2">
                <flux:select
                    wire:model="country_code"
                    name="country_code"
                    :label="__('Código de país')"
                    required
                    class="w-32"
                >
                    <option value="+1">+1 Estados Unidos / Canadá</option>
                    <option value="+44">+44 Reino Unido</option>
                    <option value="+34" selected>+34 España</option>
                    <option value="+49">+49 Alemania</option>
                    <option value="+33">+33 Francia</option>
                    <option value="+39">+39 Italia</option>
                    <option value="+52">+52 México</option>
                    <option value="+57">+57 Colombia</option>
                    <option value="+51">+51 Perú</option>
                    <option value="+54">+54 Argentina</option>
                    <option value="+55">+55 Brasil</option>
                    <option value="+58">+58 Venezuela</option>
                    <option value="+41">+41 Suiza</option>
                    <option value="+31">+31 Países Bajos</option>
                    <option value="+61">+61 Australia</option>
                    <option value="+81">+81 Japón</option>
                    <option value="+82">+82 Corea del Sur</option>
                    <option value="+86">+86 China</option>
                    <option value="+91">+91 India</option>
                    <option value="+7">+7 Rusia / Kazajistán</option>
                    <option value="+60">+60 Malasia</option>
                    <option value="+65">+65 Singapur</option>
                    <option value="+66">+66 Tailandia</option>

                </flux:select>

                <flux:input
                    wire:model="phone"
                    name="phone"
                    :label="__('Número de teléfono')"
                    type="tel"
                    required
                    autocomplete="tel"
                    :placeholder="__('Número de teléfono')"
                    class="flex-1"
                />
            </div>

            <!-- Address -->
            <flux:input
                wire:model="address"
                name="address"
                :label="__('Dirección')"
                type="text"
                autocomplete="street-address"
                :placeholder="__('Dirección')"
            />

            <!-- Date of Birth -->
            <flux:input
                wire:model="date_of_birth"
                name="date_of_birth"
                :label="__('Fecha de Nacimiento')"
                type="date"
                autocomplete="bday"
                :placeholder="__('Fecha de Nacimiento')"
            />


            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full cursor-pointer" data-test="update-profile-button">
                        {{ __('Guardar') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Guardado.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
