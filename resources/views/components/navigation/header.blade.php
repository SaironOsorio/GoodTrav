<header>
    <nav class="bg-[#5170ff] border-b-2 border-[#ff5170] px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl gap-2">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('assets/images/GoodTrav.png') }}" class="h-8 sm:h-10 lg:h-12 w-auto object-contain" alt="Goodtrav Logo" />
            </a>

            <!-- Número de teléfono -->
            <a href="tel:614189556" class="flex items-center gap-2 text-white hover:text-[#ff5170] transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                <span class="hidden sm:inline font-medium">614189556</span>
            </a>

            <div class="flex items-center gap-2 lg:order-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] font-medium rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Dashboard</a>
                @endauth
                <a href="{{ route('login') }}" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] font-medium rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Acceder</a>
                <a href="{{ route('register') }}" class="text-white bg-white/20 hover:bg-white/30 focus:ring-4 focus:ring-white/30 font-medium rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Registrarse</a>
            </div>
        </div>
    </nav>
</header>
