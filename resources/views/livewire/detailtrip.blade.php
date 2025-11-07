<div class="min-h-screen bg-white">
    {{-- Hero Section --}}
    <div class="relative bg-white">
        <div class="text-center py-12 px-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-[#5170ff] mb-3">
                {{ $trip->title }}
            </h1>
            <p class="text-gray-600 text-base md:text-lg">
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
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12">
                Itinerario – {{ $totalDays }} días, {{ $totalNights }} noches
            </h2>

            {{-- Grid de días --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                @foreach ($trip->itinerary as $day)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow h-full flex flex-col">
                        {{-- Contenido (crece) --}}
                        <div class="p-6 flex-1">
                            <div class="text-[#5170ff] text-sm font-semibold mb-3">
                                Día {{ $day['day_number'] }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">
                                {{ $day['day_title'] }}
                            </h3>
                            <p class="text-gray-700 text-sm mb-4 leading-relaxed">
                                {{ $day['description'] }}
                            </p>

                            @if(!empty($day['reto']))
                                <div class="mb-3">
                                    <p class="text-sm">
                                        <strong class="text-gray-900">Reto:</strong>
                                        <span class="text-gray-700"> {{ $day['reto'] }}</span>
                                    </p>
                                </div>
                            @endif

                            @if(!empty($day['objective']))
                                <div class="mb-4">
                                    <p class="text-sm">
                                        <strong class="text-gray-900">Objetivo:</strong>
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

    {{-- Supervisión y Alojamiento --}}
    <div class="px-4 md:px-8 py-12 md:py-16 ">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12">
                Supervisión y Alojamiento
            </h2>

            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="grid lg:grid-cols-2 gap-0">
                    {{-- Contenido de texto --}}
                    <div class="p-6 md:p-8 lg:p-12 order-1 lg:order-1 flex flex-col justify-center">
                        <div class="prose prose-sm md:prose-base max-w-none text-gray-700">
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
        <div class="max-w-7xl mx-auto bg-gradient-to-br from-green-300 via-green-400 to-green-500 rounded-2xl md:rounded-3xl p-6 md:p-12 lg:p-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 text-center mb-2 md:mb-3">
                GoodTrav Society Bonus
            </h2>
            <p class="text-center text-gray-800 mb-8 md:mb-12 text-base md:text-lg">
                ¡Forma parte de GoodTrav Society y disfruta de las ventajas exclusivas!
            </p>

            <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                {{-- Recomienda y gana --}}
                <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-6 md:p-8">
                    <h3 class="text-xl md:text-2xl font-bold text-[#5170ff] mb-4 md:mb-6">Recomienda y gana</h3>
                    <div class="space-y-1 mb-4">
                        <p class="text-gray-700 text-sm md:text-base">
                            <strong>Traer un nuevo referido:</strong> <span class="text-gray-600">+500 GT Points (¡y él también!)</span>
                        </p>
                    </div>

                    <div class="space-y-2 md:space-y-3 mt-4 md:mt-6">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-700 text-sm md:text-base">Llegar a 5 referidos</span>
                            <span class="text-[#5170ff] font-semibold text-sm md:text-base">5% de descuento</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-700 text-sm md:text-base">Llegar a 10 referidos</span>
                            <span class="text-[#5170ff] font-semibold text-sm md:text-base">10% de descuento</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-700 text-sm md:text-base">Llegar a 15 referidos</span>
                            <span class="text-[#5170ff] font-semibold text-sm md:text-base">15% de descuento</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-700 text-sm md:text-base">Llegar a 20 referidos</span>
                            <span class="text-[#5170ff] font-semibold text-sm md:text-base">20% de descuento</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-700 text-sm md:text-base">Llegar a 50 referidos</span>
                            <span class="text-[#5170ff] font-semibold text-sm md:text-base">50% de descuento</span>
                        </div>
                    </div>
                </div>

                {{-- Gana puntos extra --}}
                <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-6 md:p-8">
                    <h3 class="text-xl md:text-2xl font-bold text-[#5170ff] mb-4 md:mb-6">Gana puntos extra</h3>

                    <div class="space-y-3 md:space-y-4 mb-4 md:mb-6">
                        <p class="text-gray-700 text-sm md:text-base">
                            <strong>Asistir a un evento:</strong> <span class="text-gray-600">+1.000 GT Points (manual)</span>
                        </p>
                        <p class="text-gray-700 text-sm md:text-base">
                            <strong>Subir 4 posts, vídeos o stories al mes</strong> mencionando a <span class="text-gray-900">@goodtrav</span>: <span class="text-gray-600">+1.000 GT Points (subir prueba cada mes)</span>
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3 md:p-4 mb-4 md:mb-6">
                        <p class="text-xs md:text-sm text-gray-600">
                            *Los descuentos aplican al <strong>próximo viaje</strong>. Los GT Points se suman a tu saldo y pueden combinarse con descuentos.
                        </p>
                    </div>

                    <div class="text-center">
                        <button class="bg-[#5170ff] hover:bg-[#4060ef] text-white font-semibold px-5 md:px-6 py-2 md:py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all text-sm md:text-base">
                            Ver mi progreso
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cómo apuntarse --}}
    <div class="px-4 md:px-8 py-12 md:py-16 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#5170ff] text-center mb-8 md:mb-12">
                Cómo apuntarse
            </h2>

            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 lg:p-12">
                <ol class="space-y-3 md:space-y-4 text-gray-700 text-sm md:text-base">
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">1.</span>
                        <span>Pulsa "Solicitar plaza ahora".</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">2.</span>
                        <span>Agenda tu llamada informativa con el equipo GoodTrav.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">3.</span>
                        <span>Realiza el pago seguro (una vez o en 3 cuotas).</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">4.</span>
                        <span>Recibirás tu confirmación y factura directamente en tu correo electrónico.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">5.</span>
                        <span>Te enviaremos un e-mail con los documentos y papeles necesarios que tendrás que enviarnos de vuelta (pasaporte, DNI, <strong>documento ETA</strong> obligatorio para entrar en Reino Unido, tarjeta sanitaria y autorizaciones).</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold mr-2 flex-shrink-0">6.</span>
                        <span>Unas semanas antes de viajar, recibirás la información detallada del viaje y podrás participar en una <strong>videollamada grupal</strong> con el <strong>profesor acompañante</strong> y tus futuros compañeros. Será la oportunidad perfecta para resolver dudas, practicar inglés y conoceros antes de la aventura.</span>
                    </li>
                </ol>

                <div class="mt-6 md:mt-8 text-center">
                    <button class="bg-[#5170ff] hover:bg-[#4060ef] text-white font-semibold px-6 md:px-8 py-2.5 md:py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105 text-sm md:text-base">
                        Solicitar plaza ahora
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
