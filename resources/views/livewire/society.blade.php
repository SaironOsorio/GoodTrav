<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
    <!-- Sección izquierda -->
    <div class="space-y-6">
        <!-- ¿Qué es GoodTrav Society? -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('¿Qué es GoodTrav Society?') }}</h3>
            <p class="text-gray-600 leading-relaxed">
                {{ __('Comunidad creada por viajeros, para futuros viajeros. 
                    Aquí compartirás, inspirarás y ganarás beneficios cool por ser tú. 
                    Vive el inglés viajando, cumpliendo tus sueños y ayudando a otros a cumplir sus sueños 
                    también') }}
            </p>
        </div>

        <!-- Tareas para formar parte -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('Tareas para formar parte') }}</h3>
            <ul class="space-y-3">
                <li class="flex items-start gap-2">
                    <span class="text-[#5170ff] mt-1">•</span>
                    <span class="text-gray-700">
                        {{ __('Subir 4 posts o stories/mes mencionando a') }} <span class="font-semibold">@goodtrav</span> {{ __('(obligatorio)') }}
                    </span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-[#5170ff] mt-1">•</span>
                    <span class="text-gray-700">{{ __('Asistir a reuniones por Zoom aprox. 1/mes') }}</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-[#5170ff] mt-1">•</span>
                    <span class="text-gray-700">{{ __('Ayudar a resolver dudas en eventos o charlas cuando puedas') }}</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Sección derecha -->
    <div class="space-y-6">
        <!-- Recompensas -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('Recompensas') }}</h3>
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 text-center">
                        {{ __('+500 pts por cada referido (el nuevo también +500)') }}
                    </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 text-center">
                        {{ __('50 referidos ➝ 25% descuento en 1 viaje') }}
                    </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 text-center">
                        {{ __('100 referidos ➝ 50% descuento en 1 viaje') }}
                    </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 text-center">
                        {{ __('+1000 pts por asistir a 1 evento y resolver dudas') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Código de referidos -->
        @if (!$this->isSocietyMember)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('Únete a GoodTrav Society') }}</h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    {{ __('Para unirte a GoodTrav Society y obtener tu código de referidos, simplemente haz clic en el botón de abajo. ¡Empieza a compartir y ganar puntos hoy mismo!') }}
                </p>
                <button
                    wire:click="joinSociety"
                    class="bg-[#5170ff] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#4158d4] transition-colors cursor-pointer w-full"
                >
                    {{ __('Unirse a GoodTrav Society') }}
                </button>
            </div>

            @if(!Auth::user()->referral_code)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('¿Tienes un código de referido?') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ __('Si tienes un código de referido, ingrésalo a continuación para unirte a GoodTrav Society y comenzar a ganar puntos.') }}
                    </p>

                    @if (session()->has('error'))
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session()->has('message'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <input
                        type="text"
                        wire:model="referralCode"
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full mb-4"
                        placeholder="{{ __('Ingresa tu código de referido (ej: gt-xxxx)') }}"
                    >
                    <button
                        wire:click="applyReferralCode"
                        class="bg-[#5170ff] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#4158d4] transition-colors cursor-pointer w-full"
                    >
                        {{ __('Aplicar código de referido') }}
                    </button>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('Código de referido usado') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-2">
                        {{ __('Ya has usado el código de referido:') }}
                    </p>
                    <p class="text-[#5170ff] font-mono text-lg font-semibold">
                        {{ Auth::user()->referral_code }}
                    </p>
                </div>
            @endif

        @else
            <div class="bg-gradient-to-br from-[#5170ff] to-[#4158d4] rounded-xl shadow-sm p-6 text-white">
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
                        id="society-code"
                        class="flex-1 bg-white text-gray-800 rounded-lg px-4 py-3 font-mono text-lg"
                    >
                    <button
                        wire:click="copyCode"
                        class="bg-white text-[#5170ff] font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer"
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
                        <span class="font-bold text-2xl">{{ $referredCount }}</span> {{ __('personas referidas') }}
                    </p>
                </div>

                <button wire:click="leaveSociety" class="inline-block text-sm underline hover:text-gray-200 transition-colors cursor-pointer">
                    {{ __('Darse de baja en Society') }}
                </button>
            </div>
        @endif
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
