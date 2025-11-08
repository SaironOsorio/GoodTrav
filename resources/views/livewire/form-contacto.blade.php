<div class="max-w-screen-xl mx-auto p-4">
    <p class="mb-4 text-4xl tracking-tight font-[600] text-gray-900 dark:text-white">Contacto</p>
    <div class="grid grid-cols-1 gap-4 mb-4 text-center">
        <div class="grid grid-cols-1 gap-4 mb-4 text-center">
            <p class="font-[700] text-2xl">¿Tienes dudas?</p>
            <p class="text-lg">Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p class="text-lg">Escríbenos un mensaje y con gusto te respondemos</p>
        </div>
        <div class="grid lg:grid-cols-2 md:grid-cols-1 my-12 gap-4">
            <form wire:submit.prevent="submit" class="mx-auto lg:w-3/4 md:w-full w-full text-left">
            @if (session()->has('success'))
                <div class="mb-5 p-4 text-green-800 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200 text-left">
                    {{ session('success') }}
                </div>
            @endif

            @if ($error)
                <div class="mb-5 p-4 text-red-800 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200 text-left">
                    {{ $error }}
                </div>
            @endif

            <div class="mb-5">
                <input type="text" wire:model="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') border-red-500 @enderror" placeholder="Nombre completo" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <input type="email" wire:model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') border-red-500 @enderror" placeholder="Correo electrónico" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <input type="number" wire:model="telefono" id="telefono" inputmode="tel" style="-moz-appearance: textfield;" class="[&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('telefono') border-red-500 @enderror" placeholder="Teléfono de contacto" />
                @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <textarea wire:model="message" id="message" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('message') border-red-500 @enderror" placeholder="Mensaje"></textarea>
                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                <input wire:model="acepta_politica" id="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 @error('acepta_politica') border-red-500 @enderror" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">He leido y acepto la <a href="#" class="text-blue-500 hover:text-blue-700">política de privacidad.</a></label>
            </div>
            @error('acepta_politica') <span class="text-red-500 text-sm block mb-2">{{ $message }}</span> @enderror
            <div class="flex justify-start">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:loading.attr="disabled">
                    <span wire:loading.remove>Enviar</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </div>
            </form>

            <div class="lg:my-18 md:my-12 my-8 text-center ">
                <p class="font-[700] text-xl mb-4">Otros métodos de contacto</p>
                <ul class="text-md">
                    <li>Email: info@goodtrav.com</li>
                    <li>Teléfono: +34 91 123 45 67</li>
                </ul>
            </div>
        </div>
    </div>
</div>
