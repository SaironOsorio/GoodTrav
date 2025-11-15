@props(['heading' => '', 'subheading' => '', 'fullWidth' => false])
<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('profile.edit')" wire:navigate>{{ __('Perfil') }}</flux:navlist.item>
            <flux:navlist.item :href="route('billing')" wire:navigate>{{ __('Facturación') }}</flux:navlist.item>
            <flux:navlist.item :href="route('user-password.edit')" wire:navigate>{{ __('Contraseña') }}</flux:navlist.item>
            <flux:navlist.item wire:navigate>{{ __('Soporte') }}</flux:navlist.item>
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
