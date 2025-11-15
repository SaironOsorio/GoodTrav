<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <livewire:ads />
        <h1 class="font-bold text-4xl text-[#5170ff] poppins-bold">{{ __('Welcome back, :name!', ['name' => auth()->user()->student_name]) }}</h1>
        <h2 class="font-light text-2xl montserrat-regular">{{ __('Your summary of progress, lessons and challenges') }}</h2>
        <br>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @livewire('user-profile-card')

            @livewire('weekly-class-card')

            @livewire('weekly-challenges-card')

        </div>
        <br>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl">
            <livewire:referealcode />
        </div>
    </div>
</x-layouts.app>
