<header>
    <!-- Modal de advertencia para móviles -->
    <div id="mobileWarningModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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
                    Lo sentimos, esta plataforma no es compatible con su dispositivo.
                </h3>

                <p class="text-gray-600 dark:text-gray-300 mb-6 open-sans-regular">
                    Para disfrutar de una experiencia completa y evitar problemas en dispositivos móviles, te recomendamos acceder desde un ordenador o tablet.
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
                            <span class="text-xs text-gray-600 dark:text-gray-300"> Microsoft Edge</span>
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

    <script>
        function isMobileDevice() {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;
            return /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent.toLowerCase()) ||
                   (window.innerWidth <= 768 && ('ontouchstart' in window || navigator.maxTouchPoints > 0));
        }

        function checkMobileBeforeLogin(event) {
            if (isMobileDevice()) {
                event.preventDefault();
                document.getElementById('mobileWarningModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                return false;
            }
            return true;
        }

        function closeMobileWarning() {
            document.getElementById('mobileWarningModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Mostrar el modal si fue redirigido por el middleware
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('mobile_warning'))
                document.getElementById('mobileWarningModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            @endif
        });
    </script>

    <nav class="bg-[#5170ff] px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl gap-2">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('assets/images/GoodTrav.png') }}" class="h-8 sm:h-10 lg:h-12 w-auto object-contain" alt="Goodtrav Logo" />
            </a>


            <a href="tel:614189556" class="flex items-center gap-2 text-white hover:text-[#ff5170] transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                @php
                    $socialMedia = \App\Models\Socialmedia::first();
                    $phone = $socialMedia->phone ?? '614189556';
                @endphp
                <span class="hidden sm:inline font-medium">{{ $phone }}</span>
            </a>

            <div class="flex items-center gap-2 lg:order-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] poppins-bold font-bold rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Panel</a>
                @else
                <a href="{{ route('login') }}" onclick="return checkMobileBeforeLogin(event)" class="text-[#5170ff] bg-[#70ff51] hover:bg-[#6ee7b7] focus:ring-4 focus:ring-[#6ee7b7] font-medium poppins-bold rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Acceder</a>
                <a href="{{ route('register') }}" onclick="return checkMobileBeforeLogin(event)" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] font-medium poppins-bold rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
