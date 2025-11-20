<div class="ios-fix">
    <section class="bg-gradient-to-b from-white to-gray-50 dark:bg-gray-900 relative overflow-visible will-change-transform">
        <!-- Elementos decorativos - mejorados para móvil -->
        <div class="absolute top-10 left-4 w-48 h-48 bg-[#5170ff]/5 rounded-full blur-3xl md:top-20 md:left-10 md:w-64 md:h-64"></div>
        <div class="absolute bottom-10 right-4 w-56 h-56 bg-[#ff5170]/5 rounded-full blur-3xl md:bottom-20 md:right-10 md:w-80 md:h-80"></div>

        <div class="py-6 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative z-10">
            <!-- Header -->
            <div class="mx-auto max-w-screen-md text-center mb-6 lg:mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#5170ff] poppins-bold">Contacto</span>
                </div>

                <h2 class="mb-4 text-3xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white poppins-bold">
                    ¿Tienes dudas?
                </h2>
                <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 open-sans-regular">
                    Si tienes alguna pregunta, no dudes en contactarnos. Escríbenos un mensaje y con gusto te respondemos.
                </p>
            </div>

            <!-- Contenedor principal -->
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-12 max-w-6xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border-2 border-gray-100 dark:border-gray-700 p-4 sm:p-6 lg:p-8 space-y-6 ios-input-fix">
                    <form wire:submit.prevent="submit" class="space-y-6">

                        <!-- Mensajes -->
                        @if (session()->has('success'))
                            <div class="p-4 rounded-xl bg-gradient-to-r from-[#70ff51]/10 to-[#70ff51]/5 border border-[#70ff51]/30 flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#70ff51] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm md:text-base font-medium text-gray-900 dark:text-white">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if ($error)
                            <div class="p-4 rounded-xl bg-gradient-to-r from-red-500/10 to-red-500/5 border border-red-500/30 flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm md:text-base font-medium text-gray-900 dark:text-white">{{ $error }}</p>
                            </div>
                        @endif

                        <!-- NOMBRE -->
                        <div>
                            <label for="name" class="block mb-2 text-sm md:text-base font-bold text-gray-900 dark:text-white open-sans-medium">
                                Nombre completo
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none md:pl-4">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="text" wire:model="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-10 md:pl-12 py-3 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all appearance-none ios-input"
                                    placeholder="Tu nombre completo" />
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label for="email" class="block mb-2 text-sm md:text-base font-bold text-gray-900 dark:text-white open-sans-medium">
                                Correo electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none md:pl-4">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <input type="email" wire:model="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-10 md:pl-12 py-3 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all appearance-none ios-input"
                                    placeholder="tu@email.com" />
                            </div>
                        </div>

                        <!-- TELÉFONO -->
                        <div>
                            <label for="telefono" class="block mb-2 text-sm md:text-base font-bold text-gray-900 dark:text-white open-sans-medium">
                                Teléfono de contacto
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none md:pl-4">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <input type="tel" wire:model="telefono" id="telefono" inputmode="tel"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-10 md:pl-12 py-3 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all appearance-none ios-input"
                                    placeholder="+34 600 000 000" />
                            </div>
                        </div>

                        <!-- MENSAJE -->
                        <div>
                            <label for="message" class="block mb-2 text-sm md:text-base font-bold text-gray-900 dark:text-white open-sans-medium">
                                Mensaje
                            </label>
                            <textarea wire:model="message" id="message" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full py-3 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all resize-none appearance-none ios-textarea"
                                placeholder="Cuéntanos en qué podemos ayudarte..."></textarea>
                        </div>

                        <!-- CHECKBOX -->
                        <div>
                            <div class="flex items-start gap-3 p-3 md:p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <input wire:model="acepta_politica" id="remember" type="checkbox"
                                    class="w-4 h-4 md:w-5 md:h-5 mt-1 md:mt-0.5 border-2 border-gray-300 rounded-md bg-white focus:ring-2 focus:ring-[#5170ff] dark:bg-gray-600 dark:border-gray-500 cursor-pointer appearance-none ios-checkbox" />
                                <label for="remember" class="text-sm md:text-base text-gray-700 dark:text-gray-300 open-sans-medium">
                                    He leído y acepto la
                                    <a href="{{ route('privacity') }}" class="font-semibold text-[#5170ff] hover:text-[#ff5170] underline decoration-2 underline-offset-2">
                                        política de privacidad
                                    </a>
                                </label>
                            </div>
                        </div>

                        <!-- BOTÓN -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white font-bold rounded-xl px-6 md:px-8 py-3 md:py-4 hover:shadow-lg hover:shadow-[#5170ff]/50 focus:ring-4 focus:ring-[#5170ff]/50 transition-all duration-300 hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 cursor-pointer ios-button"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove class="text-sm md:text-base">Enviar mensaje</span>
                            <span wire:loading class="flex items-center gap-2 text-sm md:text-base">
                                <svg class="animate-spin h-4 w-4 md:h-5 md:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>

                    </form>
                </div>

                <!-- Información de contacto -->
                <div class="space-y-4 md:space-y-6">
                    <div class="bg-gradient-to-br from-[#5170ff]/10 to-[#ff5170]/10 rounded-3xl p-4 md:p-6 border-2 border-[#5170ff]/20">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-4 md:mb-6">
                            Otros métodos de contacto
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            @php
                                $socialMedia = \App\Models\Socialmedia::first();
                                $email = $socialMedia ? $socialMedia->email : 'info@goodtrav.com';
                                $phone = $socialMedia ? $socialMedia->phone : '+34911234567';
                                $whatsApp = $socialMedia ? $socialMedia->whats_app : '+34911234567';
                            @endphp

                            <!-- Email -->
                            <a href="mailto:{{ $email }}"
                            class="flex items-center gap-3 md:gap-4 p-3 md:p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group ios-link">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-r from-[#5170ff] to-[#ff5170] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 open-sans-medium">Email</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#5170ff] transition-colors open-sans-medium truncate">
                                        {{ $email }}
                                    </p>
                                </div>
                            </a>

                            <!-- Teléfono -->
                            <a href="tel:{{ $phone }}"
                            class="flex items-center gap-3 md:gap-4 p-3 md:p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group ios-link">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-r from-[#70ff51] to-[#5170ff] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 open-sans-medium">Teléfono</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#70ff51] transition-colors open-sans-medium">
                                        +{{ $phone }}
                                    </p>
                                </div>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/{{ $whatsApp }}?text={{ urlencode('Hola, me gustaría obtener más información sobre GoodTrav.') }}"
                            class="flex items-center gap-3 md:gap-4 p-3 md:p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group ios-link">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-[#70ff51] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
                                        <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 open-sans-medium">WhatsApp</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#70ff51] transition-colors open-sans-medium">
                                        Enviar mensaje
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Horario de atención -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-4 md:p-6 border-2 border-gray-100 dark:border-gray-700 shadow-lg">
                        <div class="flex items-center gap-3 mb-3 md:mb-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#70ff51]/20 flex items-center justify-center">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white open-sans-medium">
                                Horario de atención
                            </h3>
                        </div>
                        <div class="space-y-2 text-sm md:text-base text-gray-600 dark:text-gray-400">
                            <p class="flex justify-between">
                                <span class="font-semibold open-sans-medium">Lunes a Viernes:</span>
                                <span>9:00 - 18:00</span>
                            </p>
                            <p class="flex justify-between open-sans-medium">
                                <span class="font-semibold">Sábados a Domingo</span>
                                <span>Cerrado</span>
                            </p>
                        </div>
                    </div>

                    <!-- Respuesta rápida -->
                    <div class="bg-gradient-to-br from-[#70ff51]/10 to-[#70ff51]/5 rounded-3xl p-4 md:p-6 border-2 border-[#70ff51]/20">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm md:text-base open-sans-medium">Respuesta en 24h</p>
                                <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 open-sans-medium">Te respondemos en menos de un día hábil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    /* Fixes específicos para iOS */
    .ios-fix {
        -webkit-overflow-scrolling: touch;
        overflow-x: hidden;
    }

    .ios-input, .ios-textarea {
        -webkit-appearance: none;
        border-radius: 12px;
        font-size: 16px; /* Previene zoom en iOS */
        transform: translateZ(0); /* Force hardware acceleration */
    }

    .ios-input:focus, .ios-textarea:focus {
        font-size: 16px; /* Mantiene tamaño consistente en focus */
    }

    .ios-checkbox {
        -webkit-appearance: none;
        -webkit-tap-highlight-color: transparent;
    }

    .ios-checkbox:checked {
        background-color: #5170ff;
        border-color: #5170ff;
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
    }

    .ios-button {
        -webkit-tap-highlight-color: transparent;
        transform: translateZ(0);
    }

    .ios-link {
        -webkit-tap-highlight-color: rgba(81, 112, 255, 0.1);
    }

    /* Prevenir zoom en inputs en iOS */
    @media screen and (max-width: 768px) {
        input, textarea, select {
            font-size: 16px !important;
        }
    }

    /* Mejorar scroll en iOS */
    .ios-input-fix {
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush
