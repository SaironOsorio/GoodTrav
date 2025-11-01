<x-layouts.app :title="__('Study')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="font-bold text-4xl text-[#5170ff]">{{ __('Study') }}</h1>
        <h2 class="font-light text-2xl">{{ __('Online classes and weekly challenges') }}</h2>

        <div>
           @livewire('study-page')
        </div>
    </div>

</x-layouts.app>
