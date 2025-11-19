@props(['heading' => '', 'subheading' => '', 'fullWidth' => false])
<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('profile.edit')" class="poppins-bold" wire:navigate>{{ __('Perfil') }}</flux:navlist.item>
            <flux:navlist.item :href="route('billing')" class="poppins-bold" wire:navigate>{{ __('Facturación') }}</flux:navlist.item>
            <flux:navlist.item :href="route('user-password.edit')" class="poppins-bold" wire:navigate>{{ __('Contraseña') }}</flux:navlist.item>
            @php
                $socialmedia = \App\Models\Socialmedia::first();
                $whatsApp = $socialmedia ? $socialmedia->whats_app	 : '1234567890';
            @endphp
            <flux:navlist.item href="https://wa.me/{{ $whatsApp }}?text={{ urlencode('Hola, necesito soporte en GoodTrav. ¿Me podéis ayudar, por favor?') }}" class="poppins-bold" target="_blank" rel="noopener noreferrer">{{ __('Soporte') }}</flux:navlist.item>
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full {{ $fullWidth ? '' : 'max-w-lg' }}">
            {{ $slot }}
        </div>
    </div>
</div>
