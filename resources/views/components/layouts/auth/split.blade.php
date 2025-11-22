<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <!-- Modal de advertencia para móviles -->
        <div id="mobileWarningModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-3xl max-w-md w-full shadow-2xl relative">
                <button onclick="closeMobileWarning()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="p-8 text-center">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-[#5170ff] to-[#ff5170] rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-4 poppins-bold">
                        Hola 👋🏻
                        Estás usando el móvil.
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300 mb-6 open-sans-regular">
                        Puedes continuar sin problema, aunque para mejor experencia te recomendamos usar un ordenador o tablet.
                    </p>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-6">
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 open-sans-medium">
                            Navegadores recomendados:
                        </p>
                        <div class="flex justify-center gap-4">
                            <div class="text-center">
                                <span class="text-xs text-gray-600 dark:text-gray-300">Chrome</span>
                            </div>
                            <div class="text-center">
                                <span class="text-xs text-gray-600 dark:text-gray-300">Microsoft Edge</span>
                            </div>
                            <div class="text-center">
                                <span class="text-xs text-gray-600 dark:text-gray-300">Firefox</span>
                            </div>
                        </div>
                    </div>

                    <button onclick="closeMobileWarning()" class="w-full bg-gradient-to-r from-[#5170ff] to-[#ff5170] text-white font-bold rounded-lg px-6 py-3 hover:shadow-lg transition-all poppins-bold">
                        Entendido
                    </button>
                </div>
            </div>
        </div>

        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 ">
                    <img src="{{ asset('assets/images/bg_auth.png') }}" alt="GoodTrav" class="absolute inset-0 h-full w-full object-cover opacity-80" />
                </div>
                <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-40 w-40 items-center justify-center rounded-md">
                        @php
                            $settings = \App\Models\Setting::first();
                            $logoPath = $settings && $settings->image_path_authentication ? asset('storage/' . $settings->image_path_authentication) : asset('assets/images/GoodTrav.png');
                        @endphp
                        <img src="{{ $logoPath }}" alt="goodtrav logo" class="w-full h-auto" />
                    </span>
                </a>

                @php
                    $message = "Sin emoción no hay aprendizaje" ;
                    $author = "Francisco Mora, doctor en Neurociencia"
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2 ">
                        <flux:heading  class="text-white poppins-bold" size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading class="text-white montserrat-medium">{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-40 w-40 items-center justify-center rounded-md">
                            <img src="{{ asset('assets/images/GoodTrav.png') }}" alt="goodtrav logo" class="w-full h-auto" />
                        </span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
        <script>
            function isMobileDevice() {

                const userAgent = navigator.userAgent.toLowerCase();
                const isMobileUserAgent = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
                const hasTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
                const screenWidth = window.innerWidth;


                return (isMobileUserAgent && screenWidth <= 1024) ||
                       (hasTouch && screenWidth <= 768) ||
                       (screenWidth <= 480);
            }

            function closeMobileWarning() {
                const modal = document.getElementById('mobileWarningModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';

                }
            }

            function showMobileWarning() {
                const modal = document.getElementById('mobileWarningModal');
                if (modal) {
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';

                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeMobileWarning();
                        }
                    });
                }
            }


            document.addEventListener('DOMContentLoaded', function() {
                if (isMobileDevice()) {
                    setTimeout(showMobileWarning, 300);
                }
            });


            window.addEventListener('resize', function() {
                if (isMobileDevice()) {
                    showMobileWarning();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMobileWarning();
                }
            });
        </script>
    </body>
</html>
