<!-- filepath: d:\Projects\goodtrap\resources\views\livewire\ads.blade.php -->
<div>
    @if($content && $content->is_active)
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm bg-black/50">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $content->title }}
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors"
                            data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 bg-gray-50 dark:bg-gray-900">
                    @if($content->image_path)
                        @php
                            $extension = pathinfo($content->image_path, PATHINFO_EXTENSION);
                            $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'mov', 'avi']);
                        @endphp

                        @if($isVideo)
                            <!-- Video -->
                            <div class="relative rounded-xl overflow-hidden bg-black">
                                <video
                                    class="w-full h-auto max-h-[70vh] object-contain"
                                    controls
                                    autoplay
                                    muted
                                    loop>
                                    <source src="{{ Storage::url($content->image_path) }}" type="video/{{ $extension }}">
                                    Tu navegador no soporta la reproducción de video.
                                </video>
                            </div>
                        @else
                            <!-- Imagen -->
                            <div class="relative rounded-xl overflow-hidden">
                                <img
                                    src="{{ Storage::url($content->image_path) }}"
                                    alt="{{ $content->title }}"
                                    class="w-full h-auto max-h-[70vh] object-contain rounded-xl">
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>No hay contenido multimedia disponible</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const hasVisited = localStorage.getItem('hasVisitedBefore');
                const modal = document.getElementById('default-modal');

                if (!hasVisited && modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    document.body.style.overflow = 'hidden';

                    const closeButtons = document.querySelectorAll('[data-modal-hide="default-modal"]');

                    closeButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            modal.classList.add('hidden');
                            modal.classList.remove('flex');

                            document.body.style.overflow = '';

                            if (this.classList.contains('w-full') && this.tagName === 'BUTTON') {
                                localStorage.setItem('hasVisitedBefore', 'true');
                            }
                        });
                    });

                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                            document.body.style.overflow = '';
                        }
                    });

                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                            document.body.style.overflow = '';
                        }
                    });
                }
            }, 500);
        });
    </script>
@endpush
