<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Crear una cuenta')" :description="__('Ingrese sus datos a continuación para crear su cuenta.')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nombre del padre/madre o tutor legal')"
                type="text"
                autofocus
                autocomplete="name"
                :placeholder="__('Nombre completo')"
            />


            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                autocomplete="email"
                placeholder="email@example.com"
            />


            <!-- Address -->
            <flux:input
                name="address"
                :label="__('Dirección (Opcional)')"
                type="text"
                autocomplete="street-address"
                :placeholder="__('Dirección')"
            />

            <!-- Phone Number -->
            <div class="flex gap-2">
                <flux:select
                    name="country_code"
                    :label="__('Código de país')"
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
                    name="phone"
                    :label="__('Número de teléfono')"
                    type="tel"
                    autocomplete="tel"
                    :placeholder="__('Número de teléfono')"
                    class="flex-1"
                />
            </div>

            <flux:input
                name="student_name"
                :label="__('Nombre del estudiante')"
                type="text"
                autofocus
                autocomplete="name"
                :placeholder="__('Nombre completo')"
            />

            <!-- Date of Birth -->
            <flux:input
                name="date_of_birth"
                :label="__('Fecha de nacimiento del estudiante')"
                type="date"
                autocomplete="bday"
                :placeholder="__('Fecha de nacimiento')"
            />

            @php
                $countries = App\Models\Country::all();
            @endphp

            <!-- National -->
            <flux:select
                name="nationality"
                :label="__('Nacionalidad')"
                autocomplete="nationality"
            >
                <option value="">{{ __('Seleccione su nacionalidad') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </flux:select>

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Contraseña')"
                type="password"
                autocomplete="new-password"
                :placeholder="__('Contraseña')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                autocomplete="new-password"
                :placeholder="__('Confirmar contraseña')"
                viewable
            />


            <!-- Términos y condiciones -->
            <input type="hidden" name="terms" value="0">
            <flux:field variant="inline">
                <flux:checkbox name="terms" wire:model="terms" value="1" />
                <flux:label>Acepto los <a class="ml-1 text-[#5170ff] underline" href="{{ route('privacity') }}">Términos y la Política de Privacidad.</a></flux:label>
                <flux:error name="terms" />
            </flux:field>

            <!-- Autorización de audio -->
            <input type="hidden" name="audio" value="0">
            <flux:field variant="inline">
                <flux:checkbox name="audio" wire:model="audio" value="1" />
                <flux:label>Autorizo el tratamiento de los datos personales y la grabación de voz de mi hijo/a.</flux:label>
                <flux:error name="audio" />
            </flux:field>

            <!-- Confirmación de tutor legal -->
            <input type="hidden" name="autor" value="0"> 
            <flux:field variant="inline">
                <flux:checkbox name="autor" wire:model="autor" value="1" />
                <flux:label>Confirmo que soy el padre/madre/tutor legal.</flux:label>
                <flux:error name="autor" />
            </flux:field>

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full cursor-pointer" data-test="register-user-button">
                    {{ __('Crear cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('¿Ya tienes una cuenta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Iniciar sesión') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
