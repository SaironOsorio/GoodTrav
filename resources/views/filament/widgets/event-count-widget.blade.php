<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="text-lg font-bold mb-4">Configuración de Eventos</h2>
        <form wire:submit.prevent="save" class="space-y-4">
            {{ $this->form }}
            <x-filament::button type="submit">Guardar cambios</x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
