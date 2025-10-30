<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            GoodTrav
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            ═══════════════════════════════════════

            GoodTrav
            No solo aprendas inglés, vive la experiencia de comunicarte con el mundo.

            © {{ date('Y') }} GoodTrav. Todos los derechos reservados.

            Inicio: {{ config('app.url') }}
            Contacto: example@goodtrav.com

            ═══════════════════════════════════════
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
