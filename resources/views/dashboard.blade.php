<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="font-bold text-4xl text-[#5170ff]">{{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }}</h1>
        <h2 class="font-light text-2xl">{{ __('Your summary of progress, classes, and trips') }}</h2>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @livewire('user-profile-card')

            @livewire('weekly-class-card')

            @livewire('weekly-challenges-card')

        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl">
        </div>
    </div>
</x-layouts.app>
