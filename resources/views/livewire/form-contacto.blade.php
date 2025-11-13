<!-- filepath: d:\Projects\goodtrap\resources\views\livewire\form-contacto.blade.php -->
<div>
    <section class="bg-gradient-to-b from-white to-gray-50 dark:bg-gray-900 relative overflow-hidden">
        <!-- Elementos decorativos -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#5170ff]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#ff5170]/5 rounded-full blur-3xl"></div>

        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative z-10">
            <!-- Header -->
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#5170ff] poppins-bold">Contacto</span>
                </div>

                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white poppins-bold">
                    ¿Tienes dudas?
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 open-sans-regular">
                    Si tienes alguna pregunta, no dudes en contactarnos. Escríbenos un mensaje y con gusto te respondemos
                </p>
            </div>

            <!-- Contenedor principal -->
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto">
                <!-- Formulario -->
                <div class="fade-in-up">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border-2 border-gray-100 dark:border-gray-700 p-8 lg:p-10">
                        <form wire:submit.prevent="submit" class="space-y-6">
                            <!-- Mensajes de estado -->
                            @if (session()->has('success'))
                                <div class="p-4 rounded-xl bg-gradient-to-r from-[#70ff51]/10 to-[#70ff51]/5 border border-[#70ff51]/30 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-[#70ff51] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ session('success') }}</p>
                                </div>
                            @endif

                            @if ($error)
                                <div class="p-4 rounded-xl bg-gradient-to-r from-red-500/10 to-red-500/5 border border-red-500/30 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $error }}</p>
                                </div>
                            @endif

                            <!-- Campo Nombre -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white open-sans-medium">
                                    Nombre completo
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="name" id="name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-12 p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                                           placeholder="Tu nombre completo" />
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Campo Email -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white open-sans-medium">
                                    Correo electrónico
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                        </svg>
                                    </div>
                                    <input type="email" wire:model="email" id="email"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-12 p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all @error('email') border-red-500 focus:ring-red-500 @enderror"
                                           placeholder="tu@email.com" />
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Campo Teléfono -->
                            <div>
                                <label for="telefono" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white open-sans-medium">
                                    Teléfono de contacto
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                    </div>
                                    <input type="tel" wire:model="telefono" id="telefono" inputmode="tel"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full pl-12 p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all @error('telefono') border-red-500 focus:ring-red-500 @enderror [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                           placeholder="+34 600 000 000" />
                                </div>
                                @error('telefono')
                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Campo Mensaje -->
                            <div>
                                <label for="message" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white open-sans-medium">
                                    Mensaje
                                </label>
                                <textarea wire:model="message" id="message" rows="5"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all resize-none @error('message') border-red-500 focus:ring-red-500 @enderror"
                                          placeholder="Cuéntanos en qué podemos ayudarte..."></textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Checkbox política -->
                            <div>
                                <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                    <input wire:model="acepta_politica" id="remember" type="checkbox"
                                           class="w-5 h-5 mt-0.5 border-2 border-gray-300 rounded-md bg-white focus:ring-2 focus:ring-[#5170ff] focus:border-[#5170ff] dark:bg-gray-600 dark:border-gray-500 transition-all cursor-pointer @error('acepta_politica') border-red-500 @enderror" />
                                    <label for="remember" class="text-sm text-gray-700 dark:text-gray-300 open-sans-medium">
                                        He leído y acepto la
                                        <a href="{{ route('privacity') }}" class="font-semibold text-[#5170ff] hover:text-[#ff5170] underline decoration-2 underline-offset-2 transition-colors poppins-bold">
                                            política de privacidad
                                        </a>
                                    </label>
                                </div>
                                @error('acepta_politica')
                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Botón submit -->
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white font-bold rounded-xl px-8 py-4 hover:shadow-lg hover:shadow-[#5170ff]/50 focus:ring-4 focus:ring-[#5170ff]/50 transition-all duration-300 hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 cursor-pointer"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    Enviar mensaje
                                </span>
                                <span wire:loading class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Enviando...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Información de contacto -->
                <div class="fade-in-up animation-delay-200 space-y-6">
                    <!-- Otros métodos de contacto -->
                    <div class="bg-gradient-to-br from-[#5170ff]/10 to-[#ff5170]/10 rounded-3xl p-8 border-2 border-[#5170ff]/20">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                            Otros métodos de contacto
                        </h3>
                        <div class="space-y-4">
                            <!-- Email -->
                            <a href="mailto:info@goodtrav.com"
                               class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#5170ff] to-[#ff5170] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 open-sans-medium">Email</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#5170ff] transition-colors open-sans-medium">
                                        info@goodtrav.com
                                    </p>
                                </div>
                            </a>

                            <!-- Teléfono -->
                            <a href="tel:+34911234567"
                               class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#70ff51] to-[#5170ff] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 open-sans-medium">Teléfono</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#70ff51] transition-colors open-sans-medium">
                                        +34 91 123 45 67
                                    </p>
                                </div>
                            </a>

                            <a href="https://wa.me/34911234567?text={{ urlencode('Hola, me gustaría obtener más información sobre GoodTrav.') }}"
                            class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-[#70ff51]  flex items-center justify-center flex-shrink-0">
                                    <svg class=" text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor">
                                        <path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 open-sans-medium">WhatsApp</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#70ff51] transition-colors open-sans-medium">
                                        Enviar mensaje
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Horario de atención -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 border-2 border-gray-100 dark:border-gray-700 shadow-lg">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#70ff51]/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white open-sans-medium">
                                Horario de atención
                            </h3>
                        </div>
                        <div class="space-y-2 text-gray-600 dark:text-gray-400">
                            <p class="flex justify-between">
                                <span class="font-semibold open-sans-medium">Lunes - Viernes:</span>
                                <span>9:00 - 18:00</span>
                            </p>
                            <p class="flex justify-between open-sans-medium">
                                <span class="font-semibold">Sábados:</span>
                                <span>10:00 - 14:00</span>
                            </p>
                            <p class="flex justify-between open-sans-medium">
                                <span class="font-semibold">Domingos:</span>
                                <span>Cerrado</span>
                            </p>
                        </div>
                    </div>

                    <!-- Respuesta rápida -->
                    <div class="bg-gradient-to-br from-[#70ff51]/10 to-[#70ff51]/5 rounded-3xl p-6 border-2 border-[#70ff51]/20">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white open-sans-medium">Respuesta en 24h</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 open-sans-medium">Te respondemos en menos de un día hábil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
