<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
<p style="margin: 0; font-weight: 600; color: #2d3748;">GoodTrav</p>
<p style="margin: 5px 0; font-size: 14px; color: #718096;">No solo aprendas inglés, vive la experiencia de comunicarte con el mundo.</p>
<p style="margin: 10px 0 5px 0; font-size: 13px; color: #a0aec0;">© {{ date('Y') }} GoodTrav. Todos los derechos reservados.</p>
<p style="margin: 0; font-size: 12px; color: #cbd5e0;">
    <a href="{{ route('home') }}" style="color: #5170ff; text-decoration: none;">Inicio</a> •
    <a href="mailto:example@goodtrav.com" style="color: #5170ff; text-decoration: none;">Contacto</a>
</p>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
