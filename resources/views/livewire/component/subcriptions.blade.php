<div>
    <section class="bg-gradient-to-b from-white to-gray-50 dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <!-- Header -->
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#5170ff]">Planes</span>
                </div>

                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Elige tu plan perfecto
                </h2>
                <p class="mb-5 text-lg text-gray-600 dark:text-gray-400">
                    Comienza tu aventura con GoodTrav. Primera semana gratis, cancela cuando quieras.
                </p>
            </div>

            @if($subscriptions && $subscriptions->count() > 0)
                <!-- Grid de planes -->
                <div class="grid gap-8 lg:grid-cols-3 sm:grid-cols-2 xl:gap-10">
                    @foreach($subscriptions as $index => $subscription)
                        @php
                            $isPopular = $index === 1; // El segundo plan (índice 1) será el destacado
                        @endphp
                        
                        <div class="subscription-card fade-in-up animation-delay-{{ $index * 100 }} flex flex-col p-6 mx-auto max-w-lg text-center rounded-3xl border-2 relative
                            {{ $isPopular
                                ? 'bg-gradient-to-br from-[#5170ff] to-[#ff5170] border-transparent text-white shadow-2xl hover:shadow-[#5170ff]/50 transform scale-105' 
                                : 'bg-white border-gray-200 dark:bg-gray-800 dark:border-gray-600 shadow-lg hover:shadow-xl' 
                            }} 
                            transition-all duration-300 hover:-translate-y-2">
                            
                            <!-- Badge "Más popular" -->
                            @if($isPopular)
                                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                    <span class="bg-[#70ff51] text-gray-900 text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                                        ⭐ MÁS POPULAR
                                    </span>
                                </div>
                            @endif

                            <!-- Título -->
                            <h3 class="mb-4 text-2xl font-extrabold {{ $isPopular ? 'text-white' : 'text-gray-900 dark:text-white' }}">
                                {{ $subscription->title }}
                            </h3>

                            <!-- Descripción -->
                            <p class="font-light sm:text-lg {{ $isPopular ? 'text-white/90' : 'text-gray-600 dark:text-gray-400' }}">
                                {{ $subscription->description }}
                            </p>

                            <!-- Precio -->
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold {{ $isPopular ? 'text-white' : 'text-gray-900 dark:text-white' }}">
                                    €{{ ($subscription->price) }}
                                </span>
                                <span class="{{ $isPopular ? 'text-white/80' : 'text-gray-600 dark:text-gray-400' }}">
                                    /{{ $subscription->duration }} mes
                                </span>
                            </div>

                            <!-- Features -->
                            <ul role="list" class="mb-8 space-y-4 text-left flex-1">
                                @php
                                    $features = is_array($subscription->features) 
                                        ? $subscription->features 
                                        : json_decode($subscription->features, true);
                                @endphp
                                
                                @if($features)
                                    @foreach($features as $featureItem)
                                        @php
                                            // Manejar tanto formato ["texto"] como [{"feature": "texto"}]
                                            $featureText = is_array($featureItem) && isset($featureItem['feature']) 
                                                ? $featureItem['feature'] 
                                                : (is_string($featureItem) ? $featureItem : '');
                                        @endphp
                                        
                                        @if($featureText)
                                            <li class="flex items-start space-x-3">
                                                <svg class="flex-shrink-0 w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="{{ $isPopular ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}">
                                                    {{ $featureText }}
                                                </span>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>

                            <!-- Botón -->
                            <a 
                                href="{{route('register')}}"
                                class="
                                    {{ $isPopular
                                        ? 'bg-white text-[#5170ff] hover:bg-gray-100 focus:ring-4 focus:ring-white/50' 
                                        : 'bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white hover:shadow-lg hover:shadow-[#5170ff]/50 focus:ring-4 focus:ring-[#5170ff]/50' 
                                    }} 
                                    font-bold rounded-full text-base px-8 py-3.5 text-center transition-all duration-300 hover:scale-105 transform">
                                Comenzar ahora
                            </a>

                            <!-- Nota adicional -->
                            <p class="mt-4 text-xs {{ $isPopular ? 'text-white/70' : 'text-gray-500 dark:text-gray-400' }}">
                                Cancela cuando quieras
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- FAQ rápido -->
                <div class="mt-12 max-w-3xl mx-auto text-center fade-in-up animation-delay-500">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        ¿Tienes preguntas? Estamos aquí para ayudarte
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="tel:614189556" class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            614189556
                        </a>
                        <a href="mailto:info@goodtrav.com" class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            info@goodtrav.com
                        </a>
                    </div>
                </div>

            @else
                <!-- Estado vacío -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Planes próximamente
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Estamos preparando los mejores planes para ti
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>