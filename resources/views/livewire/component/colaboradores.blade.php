<div>
    <section class="bg-gradient-to-b from-gray-50 to-white dark:bg-gray-900 relative overflow-hidden">
        <!-- Elementos decorativos -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#70ff51]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#5170ff]/5 rounded-full blur-3xl"></div>

        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 relative z-10">
            <div class="mt-8 fade-in-up animation-delay-400">
                    <div class="bg-[#5170ff] rounded-3xl p-8 border-2 border-black shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex flex-col md:flex-row items-center gap-6">

                            <!-- Contenido -->
                            <div class="flex-1 text-center md:text-left">

                                @php
                                    $setting = App\Models\Setting::first();
                                    $title = $setting->title_contributors_new_title ?? ' ¿Eres profesor o coordinador de grupos?';
                                    $description = $setting->title_contributors_new_description ?? 'Únete a nuestra comunidad educativa y obtén descuentos especiales al traer a tus estudiantes. Ofrecemos condiciones exclusivas para instituciones y grupos organizados.';
                                @endphp
                                <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-2 poppins-bold">
                                    {{ $title }}
                                </h3>
                                <p class="text-base md:text-lg text-white mb-4 montserrat-regular">
                                    {{ $description }}
                                </p>
                            </div>

                            <!-- Botón de acción -->
                            <div class="flex-shrink-0">

                                @php
                                    $socialMedia = \App\Models\Socialmedia::first();
                                    $email = $socialMedia->email ?? 'info@goodtrav.com';
                                @endphp
                                <a
                                    href="mailto:{{ $email }}"
                                    class="inline-flex items-center gap-2 bg-[#70ff51] text-black font-bold rounded-full px-8 py-4 text-base transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#5170ff]/50 poppins-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Solicitar información
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .colaboradores-carousel:hover {
        animation-play-state: paused;
    }

    .colaborador-card {
        transition: all 0.3s ease;
    }

    .colaborador-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush


