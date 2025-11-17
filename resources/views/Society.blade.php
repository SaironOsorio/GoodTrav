<x-layouts.app :title="__('GoodTrav Society')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @php
            $society = App\Models\Pagesociety::first();
            $title = $society ? $society->title : __('GoodTrav Society');
            $subtitle = $society ? $society->subtitle : __('Unete, inspira a otros y gana recompensas cool mientras exploras el mundo con GoodTrav!');
        @endphp
        <h1 class="font-bold text-5xl  bg-gradient-to-br from-pink-500 to-orange-400 bg-clip-text text-transparent poppins-extrabold">{{ $title }}</h1>
        <h2 class="font-light text-2xl montserrat-medium">{{ $subtitle }}</h2>
        <livewire:society />
    </div>
</x-layouts.app>
