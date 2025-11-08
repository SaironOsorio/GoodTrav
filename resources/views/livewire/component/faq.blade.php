<div x-data="{ openQuestion: null }">
    <section class="bg-gradient-to-b from-gray-50 to-white dark:bg-gray-900 relative overflow-hidden">
        <!-- Elementos decorativos -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#ff5170]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#5170ff]/5 rounded-full blur-3xl"></div>

        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative z-10">
            <!-- Header -->
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#5170ff]">FAQ</span>
                </div>

                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Preguntas frecuentes
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Resolvemos tus dudas sobre GoodTrav
                </p>
            </div>

            @if($questions && $questions->count() > 0)
                <!-- Acordeón de preguntas -->
                <div class="max-w-4xl mx-auto space-y-4">
                    @foreach($questions as $index => $question)
                        <div 
                            x-data="{ isOpen: false }"
                            class="faq-item fade-in-up animation-delay-{{ $index * 100 }} bg-white dark:bg-gray-800 rounded-2xl border-2 border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:border-[#5170ff]/30 hover:shadow-lg">
                            
                            <!-- Pregunta (botón) -->
                            <button
                                @click="isOpen = !isOpen; openQuestion = isOpen ? {{ $question->id }} : null"
                                type="button"
                                class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left group transition-all duration-300"
                                :class="isOpen ? 'bg-gradient-to-r from-[#5170ff]/5 to-[#ff5170]/5' : 'hover:bg-gray-50 dark:hover:bg-gray-700/50'">

                                <!-- Icono de pregunta -->
                                <div class="flex items-center gap-4 flex-1">
                                    <div 
                                        class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                        :class="isOpen ? 'bg-gradient-to-r from-[#5170ff] to-[#ff5170]' : 'bg-gray-100 dark:bg-gray-700'">
                                        <svg 
                                            class="w-5 h-5 transition-colors duration-300" 
                                            :class="isOpen ? 'text-white' : 'text-gray-500 dark:text-gray-400'"
                                            fill="currentColor" 
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-[#5170ff] transition-colors">
                                        {{ $question->title }}
                                    </h3>
                                </div>

                                <!-- Icono de flecha -->
                                <div class="flex-shrink-0">
                                    <svg 
                                        class="w-6 h-6 text-gray-500 dark:text-gray-400 transition-all duration-300"
                                        :class="{ 'rotate-180 text-[#5170ff]': isOpen }"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Respuesta (panel desplegable) -->
                            <div 
                                x-show="isOpen"
                                x-collapse
                                class="overflow-hidden">
                                <div class="px-6 py-5 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-[#70ff51] flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                            {{ $question->response }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- CTA de contacto -->
                <div class="mt-12 max-w-4xl mx-auto fade-in-up animation-delay-400">
                    <div class="bg-gradient-to-r from-[#5170ff]/10 to-[#ff5170]/10 rounded-2xl p-8 border border-[#5170ff]/20 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                            ¿No encuentras lo que buscas?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            Nuestro equipo está aquí para ayudarte con cualquier pregunta
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="tel:614189556"
                               class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white font-bold rounded-full px-8 py-3.5 hover:shadow-lg hover:shadow-[#5170ff]/50 transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                Llamar ahora
                            </a>
                            <a href="mailto:info@goodtrav.com"
                               class="inline-flex items-center justify-center gap-2 bg-white dark:bg-gray-800 text-[#5170ff] font-bold rounded-full px-8 py-3.5 border-2 border-[#5170ff] hover:bg-[#5170ff] hover:text-white transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                Enviar email
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <!-- Estado vacío -->
                <div class="text-center py-16 max-w-2xl mx-auto">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Preguntas frecuentes próximamente
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Estamos preparando las respuestas a las preguntas más comunes
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="tel:614189556" class="text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors">
                            Llamar ahora →
                        </a>
                        <a href="mailto:info@goodtrav.com" class="text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors">
                            Enviar email →
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

@push('styles')
<style>
    .faq-item:hover {
        transform: translateY(-2px);
    }
</style>
@endpush