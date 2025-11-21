<div>
    {{-- Imagen Hero --}}
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
        @php
            $society = App\Models\Pagesociety::first();
            $imagePath = $society?->image ;
        @endphp
        <div class="w-full h-[400px] md:h-[500px] bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center rounded-2xl md:rounded-3xl">
            <img src="{{ Storage::url($imagePath) ?? 'https://cms-assets.tutsplus.com/cdn-cgi/image/width=360/uploads/users/1631/posts/34088/image/Banner1.jpg' }}" class="object-cover w-full h-full rounded-2xl md:rounded-3xl" alt="" />
        </div>
    </div>


    <section class="bg-white">
        <div class="py-12 px-4 mx-auto max-w-screen-xl lg:px-6">

            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="grid gap-10 md:grid-cols-2">
                    <div>
                        @php
                            $society = App\Models\Pagesociety::first();
                            $titleCardOne = $society ? $society->title_card_one : '¿Qué es GoodTrav Society?';
                            $textCardOne = $society ? $society->text_card_one : 'Comunidad creada por viajeros, para futuros viajeros. Aquí compartirás, inspirarás y ganarás beneficios cool por ser tú. Vive el inglés viajando, cumpliendo tus sueños y ayudando a otros a cumplir sus sueños también.';
                        @endphp
                        <h3 class="font-bold text-3xl text-gray-800 mb-4 poppins-bold">
                            {{ __($titleCardOne) }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed open-sans-regular">
                            {!! $textCardOne !!}
                        </p>
                    </div>

                    <div>
                        @if (!$this->isSocietyMember)

                            <div class="bg-white border rounded-xl shadow-sm p-6">
                                @php
                                    $society = App\Models\Pagesociety::first();
                                    $titleCardTwo = $society ? $society->title_card_two : 'Únete a GoodTrav Society';
                                    $textCardTwo = $society ? $society->text_card_two : 'Para unirte a GoodTrav Society y obtener tu código de referidos, simplemente haz clic en el botón de abajo. ¡Empieza a compartir y ganar puntos hoy mismo!';
                                @endphp
                                <h3 class="font-bold text-xl text-gray-800 mb-3">{{ __($titleCardTwo) }}</h3>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    {!! $textCardTwo !!}
                                </p>
                                <br>
                                <button
                                    wire:click="joinSociety"
                                    class="bg-gradient-to-br from-pink-500 to-orange-400 text-white font-semibold px-6 py-3 rounded-lg hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 transition-colors w-full cursor-pointer"
                                >
                                    {{ __('Unirse a GoodTrav Society') }}
                                </button>
                            </div>

                        @else

                            <div class="bg-gradient-to-br from-pink-500 to-orange-400 rounded-xl shadow-md p-6 text-white hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200">
                                <h3 class="font-bold text-xl mb-4">{{ __('Código de referidos:') }}</h3>

                                @if (session()->has('message'))
                                    <div class="bg-white/20 text-white px-4 py-2 rounded-lg mb-4">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <div class="flex gap-2 mb-4">
                                    <input
                                        type="text"
                                        value="{{ Auth::user()->society_code }}"
                                        readonly
                                        class="flex-1 bg-white text-gray-800 rounded-lg px-4 py-3 font-mono text-lg"
                                    >
                                    <button
                                        wire:click="copyCode"
                                        class="bg-white bg-gradient-to-br from-pink-500 to-orange-400 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer"
                                    >
                                        {{ __('Copiar') }}
                                    </button>
                                </div>

                                @php
                                    $society = \App\Models\Society::where('user_id', Auth::id())->first();
                                    $referredCount = $society ? $society->user_count : 0;
                                @endphp

                                <div class="bg-white/10 rounded-lg p-4 mb-4">
                                    <p class="text-center text-lg">
                                        <span class="font-bold text-2xl">{{ $referredCount }}</span>
                                        {{ __('personas referidas') }}
                                    </p>
                                </div>

                                <button
                                    wire:click="leaveSociety"
                                    class="text-sm underline hover:text-gray-200 transition-colors cursor-pointer"
                                >
                                    {{ __('Darse de baja en Society') }}
                                </button>
                            </div>

                        @endif
                    </div>

                </div>
            </div>

        </div>
    </section>



<!-- Contenedor principal con fondo degradado y título centrado -->
<div class="mt-8 bg-gradient-to-br from-pink-500 to-orange-400 p-8 rounded-2xl">

  <!-- Título centrado -->
  <h2 class="text-white text-3xl md:text-4xl font-bold text-center mb-8">
    {{ __('Recompensas') }}
  </h2>

  <!-- Grid con dos columnas (responsive) -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


    <div class="bg-white rounded-xl shadow-md p-6">
      <h3 class="font-semibold text-2xl text-gray-800 text-center mb-4 poppins-bold">
        Gana descuentos al <span class="text-[#5170ff] font-bold">VIAJAR</span>
      </h3>

      <div class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Llega a 5 referidos</p>
          <p class="p-3 text-gray-800 font-semibold">5% de descuento</p>
        </div>

        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Llega a 10 referidos</p>
          <p class="p-3 text-gray-800 font-semibold">10% de descuento</p>
        </div>

        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Llega a 15 referidos</p>
          <p class="p-3 text-gray-800 font-semibold">15% de descuento</p>
        </div>

        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Llega a 20 referidos</p>
          <p class="p-3 text-gray-800 font-semibold">20% de descuento</p>
        </div>

        <div class="grid grid-cols-2">
          <p class="p-3 text-gray-700 open-sans-regular">Llega a 50 referidos</p>
          <p class="p-3 text-blue-600 font-bold">50% de descuento</p>
        </div>
      </div>
    </div>

    <!-- COLUMNA DERECHA – Gana extra GT Points -->
    <div class="bg-white rounded-xl shadow-md p-6">
      <h3 class="font-semibold text-2xl text-gray-800 text-center mb-4 poppins-bold">
        {{ __('Gana extra GT Points') }}
      </h3>

      <div class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Asiste a eventos</p>
          <p class="p-3 text-gray-800 font-semibold">+1000 GT Points por evento</p>
        </div>

        <div class="grid grid-cols-2 border-b border-gray-300">
          <p class="p-3 text-gray-700 open-sans-regular">Sube 4 posts a redes mensual (etiquetándonos)</p>
          <p class="p-3 text-gray-800 font-semibold">+1000 GT Points al mes</p>
        </div>

        <div class="grid grid-cols-2">
          <p class="p-3 text-gray-700 open-sans-regular">Consigue referidos</p>
          <p class="p-3 text-gray-800 font-semibold">+500 GT Points por referido (y para el nuevo también)</p>
        </div>
      </div>

      <p class="text-xs text-black mt-3 text-center opacity-90 poppins-bold">
        *{{ __('Canjéalos en la sección "GT Points"') }}
      </p>
    </div>

  </div>
</div>


</div>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('code-copied', (event) => {
            const code = event.code;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(code).then(() => {
                    console.log('Código copiado:', code);
                }).catch(err => {
                    console.error('Error al copiar:', err);
                    fallbackCopy();
                });
            } else {
                fallbackCopy();
            }
        });
    });

    function fallbackCopy() {
        const input = document.getElementById('society-code');
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');
    }
</script>
