<div>
            @if(!Auth::user()->referral_code)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-2xl text-gray-800 mb-4">{{ __('¿Tienes un código de referido?') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ __('si un amigo te ha dado su código de referido ingrésalo y gana 500 GT points') }}
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
</div>
