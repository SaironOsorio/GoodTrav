<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Full name')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Phone Number -->
            <div class="flex gap-2">
                <flux:select
                    name="country_code"
                    :label="__('Code')"
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
                    name="phone"
                    :label="__('Phone number')"
                    type="tel"
                    required
                    autocomplete="tel"
                    :placeholder="__('Phone number')"
                    class="flex-1"
                />
            </div>

            <!-- Date of Birth -->
            <flux:input
                name="date_of_birth"
                :label="__('Date of Birth')"
                type="date"
                required
                autocomplete="bday"
                :placeholder="__('Date of Birth')"
            />

            <!-- Address -->
            <flux:input
                name="address"
                :label="__('Address')"
                type="text"
                required
                autocomplete="street-address"
                :placeholder="__('Address')"
            />

            @php
                $countries = App\Models\Country::all();
            @endphp

            <!-- National -->
            <flux:select
                name="nationality"
                :label="__('Nationality')"
                required
                autocomplete="nationality"
            >
                <option value="">{{ __('Select your nationality') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </flux:select>

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Password')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirm password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm password')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
