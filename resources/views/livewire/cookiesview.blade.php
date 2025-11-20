<div class=" dark:bg-gray-900 min-h-screen">
    <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16 lg:px-6">
        <!-- Header -->
        <div class="mb-8 fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-semibold text-[#5170ff]">Políticas</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                Política de Cookies
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Información sobre el uso de cookies en GoodTrav
            </p>
        </div>

        <!-- Contenido -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border-2 border-gray-100 dark:border-gray-700 p-8 lg:p-12">
            <div class="prose prose-lg prose-gray dark:prose-invert max-w-none
                        prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-headings:font-bold
                        prose-h1:text-3xl prose-h1:mb-6
                        prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
                        prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3
                        prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                        prose-a:text-[#5170ff] prose-a:font-semibold hover:prose-a:text-[#ff5170] prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-gray-900 dark:prose-strong:text-white prose-strong:font-bold
                        prose-ul:list-disc prose-ul:ml-6 prose-ul:mb-4
                        prose-ol:list-decimal prose-ol:ml-6 prose-ol:mb-4
                        prose-li:text-gray-700 dark:prose-li:text-gray-300 prose-li:mb-2
                        prose-code:bg-gray-100 dark:prose-code:bg-gray-700 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm
                        prose-blockquote:border-l-4 prose-blockquote:border-[#5170ff] prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-gray-600 dark:prose-blockquote:text-gray-400
                        prose-table:border-collapse prose-table:w-full
                        prose-th:bg-gray-100 dark:prose-th:bg-gray-700 prose-th:p-3 prose-th:text-left prose-th:font-bold
                        prose-td:border prose-td:border-gray-300 dark:prose-td:border-gray-600 prose-td:p-3">
                    @if($cookies->first() && $cookies->first()->content_cookies)
                        {!! $cookies->first()->content_cookies !!}
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No hay contenido disponible en este momento.</p>
                    @endif
            </div>
        </div>

        <!-- Botón de volver -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-bold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al inicio
            </a>
        </div>
    </div>
</div>
