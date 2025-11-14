<header>
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
                <a href="{{ route('login') }}" class="text-[#5170ff] bg-[#70ff51] hover:bg-[#6ee7b7] focus:ring-4 focus:ring-[#6ee7b7] font-medium poppins-bold rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Acceder</a>
                <a href="{{ route('register') }}" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] font-medium poppins-bold rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
