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

                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white poppins-bold">
                   Comienza tu aventura con GoodTrav
                </h2>
                <p class="mb-5 text-lg text-gray-600 dark:text-gray-400 montserrat-medium">
                    Explora nuestros planes y prepárate para vivir experencias inolvidables alrededor del mundo.
                </p>
            </div>

            @if($subscriptions && $subscriptions->count() > 0)
                <!-- Flex container horizontal -->
                <div class="w-full max-w-7xl mx-auto ">
                    @foreach($subscriptions as $index => $subscription)
                        @php
                            $isPopular = $index === 1;
                        @endphp

                        <div class="bg-gradient-to-br from-[#5170ff]/10 via-[#ff5170]/10 to-[#70ff51]/10 subscription-card fade-in-up animation-delay-{{ $index * 100 }} flex flex-col md:flex-row items-center gap-8 p-8 w-full rounded-3xl border-2 relative
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

                            <!-- Columna izquierda: Título, Descripción y Precio -->
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="mb-4 text-4xl font-extrabold poppins-extrabold {{ $isPopular ? 'text-white' : 'text-gray-900 dark:text-white' }}">
                                    {{ $subscription->title }}
                                </h3>

                                <div class="flex justify-center md:justify-start items-baseline mt-4">
                                    <span class="mr-2 text-4xl font-extrabold montserrat-regular {{ $isPopular ? 'text-white' : 'text-gray-900 dark:text-white' }}">
                                        €{{ ($subscription->price) }}
                                    </span>
                                    <span class="montserrat-regular text-xl {{ $isPopular ? 'text-white/80' : 'text-gray-600 dark:text-gray-400' }}">
                                        /{{ $subscription->duration }} mes
                                    </span>
                                </div>
                            </div>

                            <!-- Columna derecha: Features -->
                            <div class="flex-1">
                                <ul role="list" class="space-y-4 text-left">
                                    @php
                                        $features = is_array($subscription->features)
                                            ? $subscription->features
                                            : json_decode($subscription->features, true);
                                    @endphp

                                    @if($features)
                                        @foreach($features as $featureItem)
                                            @php
                                                $featureText = is_array($featureItem) && isset($featureItem['feature'])
                                                    ? $featureItem['feature']
                                                    : (is_string($featureItem) ? $featureItem : '');
                                            @endphp

                                            @if($featureText)
                                                <li class="flex items-start space-x-3">
                                                    <svg class="flex-shrink-0 w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="{{ $isPopular ? 'text-white' : 'text-black dark:text-gray-400' }} open-sans-regular">
                                                        {{ $featureText }}
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <!-- Columna de botón -->
                            <div class="flex flex-col items-center gap-4">
                                <a
                                    href="{{route('register')}}" onclick="return checkMobileBeforeLogin(event)"
                                    class="
                                        {{ $isPopular
                                            ? 'bg-white text-[#5170ff] hover:bg-gray-100 focus:ring-4 focus:ring-white/50'
                                            : 'bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white hover:shadow-lg hover:shadow-[#5170ff]/50 focus:ring-4 focus:ring-[#5170ff]/50'
                                        }}
                                        font-bold rounded-full text-base px-8 py-3.5 text-center transition-all duration-300 hover:scale-105 transform whitespace-nowrap poppins-bold">
                                    Comenzar ahora
                                </a>

                                <p class="text-xs open-sans-regular text-center {{ $isPopular ? 'text-white/70' : 'text-black dark:text-gray-400' }}">
                                    Cancela cuando quieras
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <br>

                   @php

                       $basePrice = $subscriptions && $subscriptions->count() ? $subscriptions->first()->price : 0;
                       $couponPercent = 25;
                       $discountedPrice = number_format($basePrice * (1 - $couponPercent / 100), 2);
                       $centrosList = $contributors->map(function($contributor) {
                           return [
                               'name' => $contributor->name,
                               'image' => $contributor->imagen_path,
                           ];
                       })->toArray();
                   @endphp

                <div class="w-full max-w-7xl mx-auto mt-6">
                    <div class="bg-gradient-to-br from-[#5170ff]/10 via-[#ff5170]/10 to-[#70ff51]/10 rounded-3xl p-6 md:p-8 border border-gray-100 dark:border-gray-700 shadow-lg">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                            @php
                                $setting = App\Models\Setting::first();
                                $title = $setting->title_contributors_list_title ?? '¿Formas parte de alguno de nuestros colaboradores?';
                                $description = $setting->title_contributors_list_subtitle ?? 'Si tu centro está en la lista, podrás aplicar un cupón y obtener un precio especial para tus estudiantes.';
                            @endphp
                            <div class="flex-1">
                                <h3 class="text-xl md:text-3xl font-extrabold text-gray-900 dark:text-white poppins-bold">
                                    {{ $title }}
                                </h3>
                                <p class="text-black text-sm dark:text-gray-300 mt-1 montserrat-regular">
                                    {{ $description }}
                                </p>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-center">
                                    <div class="text-xs text-gray-500">Precio base</div>
                                    <div class="text-base md:text-xl line-through font-extrabold text-gray-900 dark:text-white">€{{ number_format($basePrice, 2) }}/mes</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-xs text-gray-500">Precio colaboradores ({{ $couponPercent }}%)</div>
                                    <div class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-[#5170ff]">€{{ $discountedPrice }}/mes</div>
                                </div>
                            </div>
                        </div>

                        <ul class="space-y-4 w-full">
                            @foreach($centrosList as $centro)
                                <li class="flex items-center justify-between bg-white dark:bg-gray-700 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-600">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                            <img src="{{ Storage::url($centro['image']) }}" alt="{{ $centro['name']  }}">
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white montserrat-regular">{{ $centro['name'] }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        @php
                                            $socialMedia = \App\Models\Socialmedia::first();
                                            $whatsApp = $socialMedia->whats_app ?? '614189556';
                                        @endphp
                                        <a
                                            href="https://wa.me/{{ $whatsApp }}?text={{ urlencode('Hola, soy estudiante y quiero información para activar el descuento del centro: '.$centro['name'].' | Precio base: €'.number_format($basePrice,2).' -> Con cupón: €'.$discountedPrice) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 sm:gap-2 bg-[#5170ff] hover:bg-[#5972e0] text-white px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-full shadow-sm transition-transform duration-150 transform hover:-translate-y-0.5 text-xs sm:text-sm md:text-base whitespace-nowrap">
                                            Solicitar cupón aquí
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex items-center gap-3 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            <h5 class="font-black">
                                Centros verificados que nos aconsejan y confían en nosotros.
                            </h5>
                        </div>
                    </div>
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
