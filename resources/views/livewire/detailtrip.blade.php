<div class="min-h-screen bg-white">
    {{-- Hero Section --}}
    <div class="relative bg-white">
        <div class="text-center py-12 px-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-[#5170ff] mb-3 poppins-extrabold">
                {{ $trip->title }}
            </h1>
            <p class="text-gray-600 text-base md:text-lg poppins-bold">
                {{ $trip->subtitle }}
            </p>
        </div>

        {{-- Imagen Hero --}}
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="w-full h-[400px] md:h-[500px] bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center rounded-2xl md:rounded-3xl">
                <img src="{{Storage::url($trip->image_path)}}" class="object-cover w-full h-full rounded-2xl md:rounded-3xl" alt="{{ $trip->destination }}" />
            </div>
        </div>
    </div>



    {{-- Itinerario --}}
    <div class="px-4 md:px-8 py-12 md:py-16">
        <div class="max-w-7xl mx-auto">
             @php
                $startDate = \Carbon\Carbon::parse($trip->start_date);
                $endDate = \Carbon\Carbon::parse($trip->end_date);

                $totalDays = $startDate->diffInDays($endDate) + 1;
                $totalNights = $startDate->diffInDays($endDate);
            @endphp
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12 poppins-extrabold">
                Itinerario – {{ $totalDays }} días, {{ $totalNights }} noches
            </h2>

            {{-- Grid de días --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                @foreach ($trip->itinerary as $day)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow h-full flex flex-col">
                        {{-- Contenido (crece) --}}
                        <div class="p-6 flex-1">
                            <div class="text-[#5170ff] text-sm font-semibold mb-3 montserrat-bold">
                                Día {{ $day['day_number'] }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4 open-sans-bold">
                                {{ $day['day_title'] }}
                            </h3>
                            <p class="text-gray-700 text-sm mb-4 leading-relaxed open-sans-regular">
                                {{ $day['description'] }}
                            </p>

                            @if(!empty($day['reto']))
                                <div class="mb-3">
                                    <p class="text-sm">
                                        <strong class="text-gray-900 open-sans-bold">Reto:</strong>
                                        <span class="text-gray-700 open-sans-regular"> {{ $day['reto'] }}</span>
                                    </p>
                                </div>
                            @endif

                            @if(!empty($day['objective']))
                                <div class="mb-4">
                                    <p class="text-sm">
                                        <strong class="text-gray-900 open-sans-bold">Objetivo:</strong>
                                        <span class="text-gray-700"> {{ $day['objective'] }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- Imagen fija en la parte inferior --}}
                        <div class="mt-auto w-full aspect-[4/3] overflow-hidden bg-gray-100 rounded-b-2xl">
                            @if(!empty($day['day_image_path']))
                                <img
                                    src="{{ Storage::url($day['day_image_path']) }}"
                                    alt="Día {{ $day['day_number'] }} - {{ $day['day_title'] }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                    loading="lazy"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <p class="text-gray-400 text-sm">Foto del día {{ $day['day_number'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- Condiciones del Viaje --}}
        <div class="px-4 md:px-8 py-12 md:py-16 ">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12 poppins-extrabold">
               Condiciones del Viaje
            </h2>

            <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                <div class="bg-white rounded-xl md:rounded-2xl shadow  p-6 md:p-8">
                        <div class="space-y-4 prose prose-sm md:prose-base max-w-none text-gray-700 open-sans-regular">
                            {!! $trip->card_description_one !!}
                        </div>
                </div>

                <div class="bg-white rounded-xl md:rounded-2xl shadow p-6 md:p-8">
                    <div class="space-y-4 prose prose-sm md:prose-base max-w-none text-gray-700 open-sans-regular">
                        {!! $trip->card_description_two !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Supervisión y Alojamiento --}}
    <div class="px-4 md:px-8 py-12 md:py-16 ">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12 poppins-extrabold">
                Supervisión y Alojamiento
            </h2>

            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="grid lg:grid-cols-2 gap-0">
                    {{-- Contenido de texto --}}
                    <div class="p-6 md:p-8 lg:p-12 order-1 lg:order-1 flex flex-col justify-center">
                        <div class="prose prose-sm md:prose-base max-w-none text-gray-700 open-sans-regular">
                            {!! $trip->note !!}
                        </div>
                    </div>

                    {{-- Imagen --}}
                    <div class="order-2 lg:order-2 min-h-[300px] lg:min-h-0">
                        @if(!empty($trip->path_image_note))
                            <img
                                src="{{ Storage::url($trip->path_image_note) }}"
                                alt="Supervisión y Alojamiento"
                                class="w-full h-full object-cover"
                            />
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-8">
                                <p class="text-gray-400 text-sm">Foto del grupo o alojamiento</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- GoodTrav Society Bonus --}}
    <div class="px-4 md:px-8 py-12 md:py-16" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto  rounded-2xl md:rounded-3xl p-6 md:p-12 lg:p-16">
            <img src="https://www.josebernalte.com/wp-content/uploads/2016/10/16112016_blackfriday.jpg" alt="">
        </div>
    </div>

    {{-- Cómo apuntarse --}}
{{-- Cómo apuntarse --}}
<div class="px-4 md:px-8 py-12 md:py-16 bg-white" 
    x-data="{ open: false }"
    @reservation-saved.window="open = false; setTimeout(() => { window.location.reload(); }, 1500)">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12 poppins-extrabold">
            Cómo apuntarse
        </h2>

        <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 lg:p-12">

            <div class="space-y-10 prose prose-sm md:prose-base max-w-none text-gray-700 open-sans-regular">
                <style>
                    .prose ol {
                        list-style-type: decimal !important;
                        padding-left: 1.5rem !important;
                    }
                    .prose ol li {
                        padding-left: 0.5rem !important;
                        display: list-item !important;
                    }
                    .prose ol li p {
                        display: inline !important;
                        margin: 0 !important;
                    }
                </style>
                {!! $trip->requirements !!}
            </div>

            <div class="mt-6 md:mt-8 text-center">
                <button
                    @click="open = true"
                    class="bg-[#5170ff] hover:bg-[#4060ef] text-white font-semibold px-6 md:px-8 py-2.5 md:py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105 text-sm md:text-base cursor-pointer">
                    Solicitar plaza ahora
                </button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div
        x-show="open"
        x-cloak
        @click.away="open = false"
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        {{-- Overlay --}}
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0  backdrop-blur-sm bg-black/50 transition-opacity"
            @click="open = false"
        ></div>

        {{-- Modal Content --}}
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
                @click.stop
            >
                {{-- Header --}}
                <div class="bg-gradient-to-r from-[#5170ff] to-[#4060ef] px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white poppins-bold" id="modal-title">
                        Solicitar Plaza - {{ $trip->title }}
                    </h3>
                    <button
                        @click="open = false"
                        class="text-white hover:text-gray-200 transition-colors"
                    >
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Body --}}
                <div class="bg-white px-6 py-6 relative">
                    <div 
                        wire:loading 
                        wire:target="submitReservation"
                        class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-10 rounded-lg"
                    >
                        <div class="text-center">
                            <svg class="animate-spin h-12 w-12 text-[#5170ff] mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <p class="text-[#5170ff] font-semibold">Procesando tu solicitud...</p>
                        </div>
                    </div>
                    {{-- FORM Livewire --}}
                    <form id="reserveForm" wire:submit.prevent="submitReservation" class="space-y-6">
                        {{-- Nombre completo --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo *</label>
                            <input type="text" wire:model.defer="full_name" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#5170ff]">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico *</label>
                            <input type="email" wire:model.defer="email" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#5170ff]">
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono *</label>
                            <input type="tel" wire:model.defer="phone" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#5170ff]">
                        </div>

                        {{-- Select de descuento (tu bloque existente permanece; solo añadimos wire:model) --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Descuento GoodTrav Society</label>
                            @php
                                $society = \App\Models\Society::where('user_id', Auth::id())->first();
                                $refCount = $society?->user_count ?? 0;
                                $isMember = $society !== null; // Verificar si existe el registro

                                // Umbrales => porcentaje
                                $discountRules = [
                                    5  => 5,
                                    10  => 10,
                                    15  => 15,
                                    20  => 20,
                                    50  => 50,
                                ];

                                $availableDiscounts = [];
                                foreach ($discountRules as $needed => $percent) {
                                    if ($refCount >= $needed) {
                                        $availableDiscounts[$needed] = $percent;
                                    }
                                }
                            @endphp
                            
                            @if ($isMember && count($availableDiscounts) > 0)
                                <div class="mb-2 text-xs text-gray-500">
                                    Referidos: <span class="font-semibold">{{ $refCount }}</span>
                                </div>
                                <select wire:model.defer="gts_member" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#5170ff]">
                                    <option value="">Sin descuento</option>
                                    @foreach ($availableDiscounts as $needed => $percent)
                                        <option value="{{ $percent }}">{{ $percent }}% de descuento ({{ $needed }} referidos)</option>
                                    @endforeach
                                </select>
                            @elseif($isMember)
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-sm text-yellow-800">
                                        <strong>Eres miembro de GoodTrav Society</strong><br>
                                        Tienes {{ $refCount }} referidos. Necesitas al menos 10 para obtener descuentos.
                                    </p>
                                </div>
                                <input type="hidden" wire:model.defer="gts_member" value="">
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-sm text-gray-600">
                                        No eres miembro de GoodTrav Society. 
                                        <a href="{{ route('society') }}" class="text-[#5170ff] hover:underline font-semibold">Únete aquí</a>
                                    </p>
                                </div>
                                <input type="hidden" wire:model.defer="gts_member" value="">
                            @endif
                        </div>

                        {{-- Fecha/hora llamada --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Agenda tu llamada * Selecciona fecha y hora diferente a la actual</label>
                            <input type="datetime-local" wire:model.defer="date_call" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#5170ff]">
                        </div>

                        {{-- Términos --}}
                        <div class="flex items-start">
                            <input type="checkbox" wire:model.defer="terms" required class="mt-1 h-4 w-4 text-[#5170ff] border-gray-300 rounded">
                            <label class="ml-3 text-sm text-gray-600">Acepto los términos y la política de privacidad</label>
                        </div>

                        {{-- Errores --}}
                        @error('full_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        @error('gts_member') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        @error('date_call') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        @error('terms') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </form>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                    <button
                        @click="open = false"
                        type="button"
                        class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-100 transition cursor-pointer"
                    >
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        form="reserveForm"
                        wire:loading.attr="disabled"
                        wire:target="submitReservation"
                        class="w-full sm:w-auto px-6 py-3 bg-[#5170ff] hover:bg-[#4060ef] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    >
                        {{-- Spinner (solo visible mientras carga) --}}
                        <svg 
                            wire:loading 
                            wire:target="submitReservation"
                            class="animate-spin h-5 w-5 text-white" 
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24"
                        >
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>

                        {{-- Texto que cambia --}}
                        <span wire:loading.remove wire:target="submitReservation">
                            Enviar solicitud
                        </span>
                        <span wire:loading wire:target="submitReservation">
                            Enviando...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
