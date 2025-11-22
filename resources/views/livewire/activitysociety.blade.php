<div class="overflow-x-auto">
    @if(!$isSocietyMember)
        <!-- Mensaje de bloqueo para no miembros -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">

            <h3 class="text-2xl font-extrabold text-gray-700 mb-4 poppins-bold">
                No eres miembro de Goodtrav Society
            </h3>

            <p class="text-gray-600 mb-6 montserrat-regular max-w-md mx-auto">
                Para acceder a estas actividades exclusivas y ganar GT Points extra, necesitas ser parte de nuestra comunidad Society.
            </p>


            <div class="mt-6">
                <a href="{{ route('society') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-orange-400 hover:from-pink-600 hover:to-orange-500 text-white font-bold px-6 py-3 rounded-lg transition-all poppins-bold shadow-lg hover:shadow-xl">
                    {{ __('Únete a Goodtrav Society') }}
                </a>
            </div>
        </div>
    @else
        <!-- Contenido original para miembros de Society -->
    <table class="w-full border-collapse">
        <thead>
        </thead>
        <tbody>
            <!-- Subir 4 posts a redes -->
            <tr class="border-b border-gray-200">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div>
                            <h4 class="font-semibold poppins-bold">{{ __('Sube 4 posts a redes (etiquetándonos)') }}</h4>
                            <p class="text-xs text-gray-500 montserrat-regular">{{ __('Instagram Stories, Reels, Videos TikTok') }}</p>
                            <p class="text-xs text-gray-500 montserrat-regular">{{ __('(mensual)') }}</p>
                        </div>
                    </div>
                </td>
                <td class="p-4 text-center">
                    <span class="font-bold text-black poppins-bold">1000 GT Points</span>
                </td>
                <td class="p-4 text-center">
                    @if($is_activity_completed)
                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('✓ Completado') }}
                        </span>
                    @else
                        <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('Subir Prueba') }}
                        </span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    @if($is_activity_completed)
                        <button disabled class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl text-white px-4 py-2 rounded-lg text-sm cursor-not-allowed poppins-medium">
                            {{ __('Completado') }}
                        </button>
                    @elseif($pendingActivity)
                        <div class="flex flex-col items-center gap-2">
                            <img src="{{ Storage::url($pendingActivity->image_path) }}" alt="Imagen pendiente" class="w-24 h-24 object-cover rounded-lg border-2 border-yellow-400">
                            <span class="text-xs text-yellow-600 font-medium">{{ __('Esperando aprobación') }}</span>
                        </div>
                    @else
                        <form wire:submit.prevent="uploadImage" class="flex flex-col items-center gap-2">
                            <div class="flex items-center gap-2">
                                <label class="cursor-pointer bg-gradient-to-br from-blue-500 to-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                    {{ __('Seleccionar archivo') }}
                                    <input type="file" wire:model="image" class="hidden" accept="image/*">
                                </label>

                                @if($image)
                                    <button type="submit" class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                                        @if($uploading)
                                            <span class="animate-pulse">{{ __('Subiendo...') }}</span>
                                        @else
                                            {{ __('Completar') }}
                                        @endif
                                    </button>
                                @endif
                            </div>

                            <div wire:loading wire:target="image" class="mt-2">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">{{ __('Cargando imagen...') }}</span>
                                </div>
                            </div>

                            @if($image)
                                <div class="mt-2" wire:loading.remove wire:target="image">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg border-2 border-blue-400">
                                    <p class="text-xs text-gray-500 mt-1">{{ __('Vista previa') }}</p>
                                </div>
                            @endif

                            @error('image')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror

                            @if($successMessage)
                                <span class="text-green-500 text-xs mt-1">{{ $successMessage }}</span>
                            @endif
                        </form>
                    @endif
                </td>
            </tr>

            <!-- Asiste a un evento -->
            <tr class="border-b border-gray-200">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div>
                            <h4 class="font-semibold poppins-bold">{{ __('Asiste a un evento') }}</h4>
                            <p class="text-xs text-gray-500 montserrat-regular">{{ __('Cada evento') }}</p>
                        </div>
                    </div>
                </td>
                <td class="p-4 text-center">
                    <span class="font-bold text-black poppins-bold">1000 GT Points</span>
                </td>
                <td class="p-4 text-center">
                    @if($is_activity_event_completed)
                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('✓ Completado') }}
                        </span>
                    @else
                        <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('Subir Prueba') }}
                        </span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    @if($is_activity_event_completed)
                        <button disabled class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl text-white px-4 py-2 rounded-lg text-sm cursor-not-allowed poppins-medium">
                            {{ __('Completado') }}
                        </button>
                    @elseif($pendingEventActivity)
                        <div class="flex flex-col items-center gap-2">
                            <img src="{{ Storage::url($pendingEventActivity->image_path) }}" alt="Imagen pendiente" class="w-24 h-24 object-cover rounded-lg border-2 border-yellow-400">
                            <span class="text-xs text-yellow-600 font-medium">{{ __('Esperando aprobación') }}</span>
                        </div>
                    @else
                        <form wire:submit.prevent="uploadImageEvent" class="flex flex-col items-center gap-2">
                            <div class="flex items-center gap-2">
                                <label class="cursor-pointer bg-gradient-to-br from-blue-500 to-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                    {{ __('Seleccionar archivo') }}
                                    <input type="file" wire:model="imageEvent" class="hidden" accept="image/*">
                                </label>

                                @if($imageEvent)
                                    <button type="submit" class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                                        @if($uploadingEvent)
                                            <span class="animate-pulse">{{ __('Subiendo...') }}</span>
                                        @else
                                            {{ __('Completar') }}
                                        @endif
                                    </button>
                                @endif
                            </div>

                            <!-- Indicador de carga mientras se selecciona la imagen -->
                            <div wire:loading wire:target="imageEvent" class="mt-2">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">{{ __('Cargando imagen...') }}</span>
                                </div>
                            </div>

                            <!-- Preview de la imagen seleccionada -->
                            @if($imageEvent)
                                <div class="mt-2" wire:loading.remove wire:target="imageEvent">
                                    <img src="{{ $imageEvent->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg border-2 border-blue-400">
                                    <p class="text-xs text-gray-500 mt-1">{{ __('Vista previa') }}</p>
                                </div>
                            @endif

                            @error('imageEvent')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror

                            @if($successMessageEvent)
                                <span class="text-green-500 text-xs mt-1">{{ $successMessageEvent }}</span>
                            @endif
                        </form>
                    @endif
                </td>
                </td>
            </tr>

            <!-- Trae a un amigo -->
            <tr class="border-b border-gray-200">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div>
                            <h4 class="font-semibold poppins-bold">{{ __('Trae a un amigo') }}</h4>
                            <p class="text-xs text-gray-500 montserrat-regular">{{ __('Cada referido') }}</p>
                        </div>
                    </div>
                </td>
                <td class="p-4 text-center">
                    <span class="font-bold text-black poppins-bold">500 GT Points</span>
                </td>
                <td class="p-4 text-center">
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                        {{ __('Automático') }}
                    </span>
                </td>
                <td class="p-4 text-center">
                    <button type="button" class="inline-block bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-none">
                        {{ $count_user ?? 0 }}
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
</div>
