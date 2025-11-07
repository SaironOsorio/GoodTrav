<x-layouts.app :title="__('Details Trip')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div>
            <livewire:detailtrip :tripData="$trip" />
        </div>
    </div>

</x-layouts.app>