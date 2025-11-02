<div class="space-y-6" x-data="paymentMethodComponent()">
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
            {{ __('Métodos de Pago') }}
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Gestiona tus tarjetas de crédito y débito.') }}
        </p>
    </div>

    {{-- Mensajes --}}
    @if (session()->has('payment-updated'))
        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('payment-updated') }}</p>
        </div>
    @endif

    @if (session()->has('payment-error'))
        <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <p class="text-sm text-red-800 dark:text-red-200">{{ session('payment-error') }}</p>
        </div>
    @endif

    {{-- Tarjetas existentes --}}
    @if(count($paymentMethods) > 0)
        <div class="space-y-3">
            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Tarjetas guardadas') }}
            </h4>

            @foreach($paymentMethods as $method)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ strtoupper($method['brand']) }} •••• {{ $method['last4'] }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Expira') }} {{ $method['exp_month'] }}/{{ $method['exp_year'] }}
                            </p>
                        </div>

                        @if($method['is_default'])
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200 rounded">
                                {{ __('Predeterminada') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        @if(!$method['is_default'])
                            <flux:button
                                class="cursor-pointer"
                                size="sm"
                                variant="ghost"
                                wire:click="setDefaultPaymentMethod('{{ $method['id'] }}')"
                            >
                                {{ __('Predeterminada') }}
                            </flux:button>
                        @endif

                        <flux:button
                            class="cursor-pointer"
                            size="sm"
                            variant="danger"
                            wire:click="deletePaymentMethod('{{ $method['id'] }}')"
                            wire:confirm="{{ __('¿Eliminar esta tarjeta?') }}"
                        >
                            {{ __('Eliminar') }}
                        </flux:button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Formulario nueva tarjeta --}}
    @if($clientSecret)
        <div class="border-t border-neutral-200 dark:border-neutral-700 pt-6">
            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                {{ __('Agregar nueva tarjeta') }}
            </h4>

            <div
                x-ref="cardElement"
                class="p-3 border border-neutral-200 dark:border-neutral-700 rounded-lg bg-white dark:bg-zinc-900 mb-4"
            ></div>

            <div x-ref="cardErrors" class="text-sm text-red-600 dark:text-red-400 mb-4"></div>

            <flux:button
                class="cursor-pointer w-full"
                variant="primary"
                @click="handleCardSubmit"
                x-bind:disabled="processing"
            >
                <span x-show="!processing">{{ __('Guardar tarjeta') }}</span>
                <span x-show="processing" class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Procesando...') }}
                </span>
            </flux:button>
        </div>
    @endif

    @assets
    <script src="https://js.stripe.com/v3/"></script>
    @endassets


    @script
    <script>
        Alpine.data('paymentMethodComponent', () => ({
            stripe: null,
            elements: null,
            cardElement: null,
            processing: false,
            clientSecret: @js($clientSecret),

            init() {
                console.log('Init - Client Secret:', this.clientSecret);

                this.$nextTick(() => {
                    this.initializeStripe();
                });

                Livewire.hook('morph.updated', () => {
                    console.log('Morph updated - Client Secret:', this.clientSecret);
                    this.$nextTick(() => {
                        if (this.clientSecret && !this.cardElement) {
                            this.initializeStripe();
                        }
                    });
                });


                Livewire.on('payment-method-added', (event) => {
                    console.log('Payment method added - New Client Secret:', event.clientSecret);


                    this.clientSecret = event.clientSecret;


                    this.resetFormWithNewSecret();
                });
            },

            initializeStripe() {
                if (!this.clientSecret || !this.$refs.cardElement) {
                    console.log('No se puede inicializar - clientSecret:', this.clientSecret, 'cardElement:', this.$refs.cardElement);
                    return;
                }

                try {

                    if (this.cardElement) {
                        console.log('Desmontando cardElement anterior');
                        this.cardElement.unmount();
                        this.cardElement = null;
                    }


                    this.stripe = Stripe('{{ config('cashier.key') }}');
                    this.elements = this.stripe.elements();


                    this.cardElement = this.elements.create('card', {
                        style: {
                            base: {
                                fontSize: '16px',
                                color: '#32325d',
                                '::placeholder': {
                                    color: '#aab7c4',
                                },
                            },
                        },
                    });


                    this.cardElement.mount(this.$refs.cardElement);


                    this.cardElement.on('change', (event) => {
                        this.$refs.cardErrors.textContent = event.error ? event.error.message : '';
                    });

                    console.log('Stripe inicializado correctamente con client secret:', this.clientSecret);
                } catch (error) {
                    console.error('Error inicializando Stripe:', error);
                }
            },

            async handleCardSubmit() {
                if (this.processing || !this.cardElement) {
                    return;
                }

                this.processing = true;
                this.$refs.cardErrors.textContent = '';

                try {
                    const { setupIntent, error } = await this.stripe.confirmCardSetup(
                        this.clientSecret,
                        {
                            payment_method: {
                                card: this.cardElement,
                                billing_details: {
                                    name: '{{ auth()->user()->name }}',
                                    email: '{{ auth()->user()->email }}'
                                }
                            }
                        }
                    );

                    if (error) {
                        this.$refs.cardErrors.textContent = error.message;
                        this.processing = false;
                    } else {

                        await $wire.addPaymentMethod(setupIntent.payment_method);
                        this.processing = false;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.$refs.cardErrors.textContent = 'Ocurrió un error al procesar la tarjeta.';
                    this.processing = false;
                }
            },


            resetFormWithNewSecret() {
                console.log('Reinicializando formulario con nuevo secret');

                if (this.cardElement) {
                    this.cardElement.clear();
                }

                this.$refs.cardErrors.textContent = '';
                this.processing = false;

                this.$nextTick(() => {
                    this.initializeStripe();
                });
            },

            resetForm() {
                if (this.cardElement) {
                    this.cardElement.clear();
                }
                this.$refs.cardErrors.textContent = '';
                this.processing = false;
            },

            destroy() {
                if (this.cardElement) {
                    this.cardElement.unmount();
                    this.cardElement = null;
                }
            }
        }));
    </script>
    @endscript
</div>
