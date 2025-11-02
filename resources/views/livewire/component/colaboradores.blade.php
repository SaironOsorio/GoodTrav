<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
            <div class="mx-auto flex justify-center items-center mb-8 max-w-screen-sm lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">CENTROS COLABORADORES</h2>
            </div> 
            
            @if(count($colaboradores) > 4)
                <!-- Carousel automático -->
                <div class="relative overflow-hidden">
                    <div class="flex" id="colaboradores-carousel" data-carousel data-duration="10000" data-drag-speed="1.0">
                        <!-- Duplicamos las opiniones para el efecto infinito -->
                        @foreach (array_merge($colaboradores, $colaboradores) as $colaborador)
                        <div class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4">
                            <div class="text-center text-gray-500 dark:text-gray-400">
                                <img class="mx-auto mb-4 w-36 h-36" src="{{ $colaborador['imagen'] }}" alt="Avatar">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Grid estático para 4 o menos elementos -->
                <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($colaboradores as $colaborador)
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <img class="mx-auto mb-4 w-36 h-36" src="{{ $colaborador['imagen'] }}" alt="Avatar">
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
