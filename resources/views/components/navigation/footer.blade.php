<footer class="bg-[#5170ff]">
    <div class="container p-6 mx-auto">
        <div class="lg:flex">
            <div class="w-full -mx-6 lg:w-2/5">
                <div class="px-6">
                    <a href="{{ route('home') }}">
                        <img class="w-auto h-7" src="{{ asset('assets/images/GoodTrav.png') }}" alt="">
                    </a>

                    <p class="max-w-sm mt-2 text-white font-medium">No solo aprendas inglés, vive la experiencia de comunicarte con el mundo.</p>

                    @php
                        $socialMedia = \App\Models\Socialmedia::first();
                        $tiktok = $socialMedia?->tiktok ?? 'goodtrap';
                        $instagram = $socialMedia?->instagram ?? 'goodtrap';
                    @endphp

                    <div class="flex mt-6 -mx-2">
                        <a href="https://www.instagram.com/{{ $instagram }}" target="_blank"
                            class="mx-2 text-white transition-colors duration-300"
                            aria-label="Instagram">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>

                        <a href="https://www.tiktok.com/search/user?q={{ $tiktok }}" target="_blank"
                            class="mx-2 text-white transition-colors duration-300"
                            aria-label="TikTok">
                            <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M448.5 209.9c-44 .1-87-13.6-122.8-39.2l0 178.7c0 33.1-10.1 65.4-29 92.6s-45.6 48-76.6 59.6-64.8 13.5-96.9 5.3-60.9-25.9-82.7-50.8-35.3-56-39-88.9 2.9-66.1 18.6-95.2 40-52.7 69.6-67.7 62.9-20.5 95.7-16l0 89.9c-15-4.7-31.1-4.6-46 .4s-27.9 14.6-37 27.3-14 28.1-13.9 43.9 5.2 31 14.5 43.7 22.4 22.1 37.4 26.9 31.1 4.8 46-.1 28-14.4 37.2-27.1 14.2-28.1 14.2-43.8l0-349.4 88 0c-.1 7.4 .6 14.9 1.9 22.2 3.1 16.3 9.4 31.9 18.7 45.7s21.3 25.6 35.2 34.6c19.9 13.1 43.2 20.1 67 20.1l0 87.4z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 lg:mt-0 lg:flex-1">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <div>
                        <h3 class="text-white font-bold uppercase">Legal</h3>
                        <a href="{{ route('legal') }}" class="block mt-2 text-sm text-white font-medium hover:underline">Aviso Legal</a>
                        <a href="{{ route('privacity') }}" class="block mt-2 text-sm text-white font-medium hover:underline">Politica Privacidad</a>
                        <a href="{{ route('cookies') }}" class="block mt-2 text-sm text-white font-medium hover:underline">Politica de Cookies</a>
                    </div>

                    <div>
                        <h3 class="text-white font-bold uppercase">Horario</h3>
                        <span class="block mt-2 text-sm text-white font-medium">Lunes a Jueves</span>
                        <span class="block mt-2 text-sm text-white font-medium">8:00 - 28:00</span>
                        <span class="block mt-2 text-sm text-white font-medium">Viernes</span>
                        <span class="block mt-2 text-sm text-white font-medium">8:00 - 15:00</span>
                    </div>

                    <div>
                        @php
                            $socialMedia = \App\Models\Socialmedia::first();
                            $phone = $socialMedia->phone ?? '614189556';
                            $email = $socialMedia->email ?? 'example@email.com';
                        @endphp
                        <h3 class="text-white font-bold uppercase">Contact</h3>
                        <a href="tel:{{ $phone }}" class="block mt-2 text-sm text-white font-medium hover:underline">{{ $phone }}</a>
                        <a href="mailto:{{ $email }}" class="block mt-2 text-sm text-white font-medium hover:underline">{{ $email }}</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="h-px my-6 bg-gray-200 border-none dark:bg-gray-700">

        <div>
            <p class="text-center text-white font-bold">© GoodTrav <span id="year"></span> - Todos los derechos reservados</p>
        </div>
    </div>
</footer>

<script>
    const currentYear = new Date().getFullYear();
    document.getElementById("year").textContent = currentYear;
</script>
