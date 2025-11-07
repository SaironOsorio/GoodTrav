<x-layouts.app :title="__('GoodTrav Society')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="font-bold text-4xl text-[#5170ff]">{{ __('GoodTrav Society') }}</h1>
        <h2 class="font-light text-2xl">{{ __('Join a community of travelers and learners') }}</h2>

        <livewire:society />
    </div>
</x-layouts.app>
