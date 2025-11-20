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
                    Si tienes alguna pregunta, no dudes en contactarnos. Escríbenos un mensaje y con gusto te respondemos.
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

                            @php
                                $socialMedia = \App\Models\Socialmedia::first();
                                $email = $socialMedia ? $socialMedia->email : 'info@goodtrav.com';
                                $phone = $socialMedia ? $socialMedia->phone : '+34911234567';
                                $whatsApp = $socialMedia ? $socialMedia->whats_app : '+34911234567';

                            @endphp
                            <!-- Email -->
                            <a href="mailto:{{ $email }}"
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
                                        {{ $email }}
                                    </p>
                                </div>
                            </a>

                            <!-- Teléfono -->
                            <a href="tel:{{ $phone }}"
                               class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#70ff51] to-[#5170ff] flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 open-sans-medium">Teléfono</p>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-[#70ff51] transition-colors open-sans-medium">
                                        +{{ $phone }}
                                    </p>
                                </div>
                            </a>

                            <a href="https://wa.me/{{ $whatsApp }}?text={{ urlencode('Hola, me gustaría obtener más información sobre GoodTrav.') }}"
                            class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl hover:shadow-lg transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-[#70ff51]  flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
                                        <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
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
                                <span class="font-semibold open-sans-medium">Lunes a Viernes:</span>
                                <span>9:00 - 18:00</span>
                            </p>
                            <p class="flex justify-between open-sans-medium">
                                <span class="font-semibold">Sabados a Domingo</span>
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
