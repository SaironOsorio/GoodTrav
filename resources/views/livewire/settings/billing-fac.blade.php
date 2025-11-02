{{-- filepath: d:\Projects\goodtrap\resources\views\livewire\settings\billing-fac.blade.php --}}
<section class="w-full" wire:key="billing-fac-{{ auth()->id() }}">
    @include('partials.settings-heading')

    <x-settings.layout
        :heading="__('Facturación')"
        :subheading="__('Descarga tus facturas de tus suscripciones y pagos realizados.')"
        :fullWidth="true"
    >
        <div class="mt-6 space-y-6">
            {{-- Mensajes --}}
            @if (session()->has('billing-error'))
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <p class="text-sm text-red-800 dark:text-red-200">{{ session('billing-error') }}</p>
                </div>
            @endif

            {{-- Loading --}}
            @if($loading)
                <div class="flex items-center justify-center p-12">
                    <svg class="animate-spin h-10 w-10 text-[#5170ff]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="ml-3 text-gray-600 dark:text-gray-400">{{ __('Cargando facturas...') }}</span>
                </div>
            @else
                {{-- Sin facturas --}}
                @if(count($invoices) === 0)
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No hay facturas') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Aún no tienes facturas disponibles.') }}</p>
                    </div>
                @else
                    {{-- Tabla de facturas --}}
                    <div class="overflow-x-auto border border-neutral-200 dark:border-neutral-700 rounded-xl">
                        <table class="min-w-full w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-zinc-800">
                                <tr>
                                    <th scope="col" class="w-[30%] px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Factura') }}
                                    </th>
                                    <th scope="col" class="w-[15%] px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Fecha') }}
                                    </th>
                                    <th scope="col" class="w-[20%] px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Periodo') }}
                                    </th>
                                    <th scope="col" class="w-[15%] px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Monto') }}
                                    </th>
                                    <th scope="col" class="w-[10%] px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Estado') }}
                                    </th>
                                    <th scope="col" class="w-[10%] px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-zinc-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                                @foreach($invoices as $index => $invoice)
                                    <tr wire:key="invoice-{{ $invoice['id'] }}" class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                                                    <svg class="h-7 w-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        {{ $invoice['number'] ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                        {{ $invoice['id'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">{{ $invoice['date'] }}</div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-gray-900 dark:text-white">
                                                {{ $invoice['period_start'] }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                hasta {{ $invoice['period_end'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-base font-bold text-gray-900 dark:text-white">
                                                {{ number_format($invoice['amount'], 2) }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $invoice['currency'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($invoice['status'] === 'paid')
                                                <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200">
                                                    {{ __('Pagada') }}
                                                </span>
                                            @elseif($invoice['status'] === 'open')
                                                <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-200">
                                                    {{ __('Pendiente') }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 dark:bg-gray-900/20 text-gray-800 dark:text-gray-200">
                                                    {{ ucfirst($invoice['status']) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button
                                                    type="button"
                                                    wire:click="viewInvoice('{{ $invoice['id'] }}')"
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors cursor-pointer"
                                                    title="{{ __('Ver factura') }}"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>

                                                <button
                                                    type="button"
                                                    wire:click="downloadInvoice('{{ $invoice['id'] }}')"
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-[#5170ff] rounded-lg hover:bg-[#4060ef] transition-colors cursor-pointer"
                                                    title="{{ __('Descargar PDF') }}"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Resumen --}}
                    <div class="mt-6 bg-gray-50 dark:bg-zinc-800 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Total de facturas') }}</p>
                                <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ count($invoices) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Facturas pagadas') }}</p>
                                <p class="mt-1 text-2xl font-semibold text-green-600 dark:text-green-400">
                                    {{ collect($invoices)->where('status', 'paid')->count() }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Total pagado') }}</p>
                                <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ number_format(collect($invoices)->where('status', 'paid')->sum('amount'), 2) }} {{ $invoices[0]['currency'] ?? 'USD' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </x-settings.layout>

    @script
    <script>
        // Abrir factura en nueva pestaña
        Livewire.on('open-invoice', (event) => {
            console.log('Abriendo factura:', event.url);
            window.open(event.url, '_blank');
        });

        // Descargar factura PDF
        Livewire.on('download-invoice', (event) => {
            console.log('Descargando factura:', event.url);
            window.open(event.url, '_blank');
        });
    </script>
    @endscript
</section>
