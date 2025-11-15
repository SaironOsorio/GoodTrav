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
    <div class="px-4 md:px-8 py-12 md:py-16">
        <div class="max-w-7xl mx-auto  rounded-2xl md:rounded-3xl p-6 md:p-12 lg:p-16">
            <img src="https://www.josebernalte.com/wp-content/uploads/2016/10/16112016_blackfriday.jpg" alt="">
        </div>
    </div>

    {{-- Cómo apuntarse --}}
    <div class="px-4 md:px-8 py-12 md:py-16 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12 poppins-extrabold">
                Cómo apuntarse
            </h2>

            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 lg:p-12">

            <div class=" space-y-10 prose prose-sm md:prose-base max-w-none text-gray-700 open-sans-regular">
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
                    <button class="bg-[#5170ff] hover:bg-[#4060ef] text-white font-semibold px-6 md:px-8 py-2.5 md:py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105 text-sm md:text-base">
                        Solicitar plaza ahora
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
