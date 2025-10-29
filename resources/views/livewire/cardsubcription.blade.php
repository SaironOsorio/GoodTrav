<div>
    <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Designed for business teams like yours</h2>
                    <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
                </div>
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    @foreach ($subscriptions as $subscription)
                        <!-- Card -->
                        <div class="flex flex-col lg:flex-row gap-8 p-8 mx-auto text-left bg-[#ff5170] rounded-2xl border border-[#ff5170] mb-8">
                            <!-- Left side: Title and Features -->
                            <div class="flex-1">
                                <h3 class="mb-2 text-3xl font-bold text-white">{{ $subscription['type'] }}</h3>
                                <p class="text-white text-base mb-8 font-medium">{{ $subscription['description'] ?? 'Best for large scale uses and extended redistribution rights.' }}</p>

                                <!-- Features Grid (3 columns) -->
                                <ul role="list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($subscription['features'] as $feature)
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-[#70ff51]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                                        </svg>

                                        <span class="text-white font-medium text-sm">{{ $feature }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Right side: Price and CTA -->
                            <div class="lg:w-80 flex flex-col justify-center items-center bg-[#5170ff] rounded-xl p-8">
                                <div class="text-center mb-6">
                                    <span class="text-6xl font-bold text-white">${{ $subscription['price'] }}</span>
                                    <p class="text-white font-medium mt-2">per month</p>
                                </div>

                                <button class="w-full text-black bg-[#70ff51] hover:bg-[#60e041] focus:ring-4 focus:ring-[#70ff51] font-medium rounded-lg text-sm px-6 py-3 text-center transition-all mb-3 cursor-pointer">
                                    Buy now
                                </button>

                                <a href="#" class="text-sm text-white hover:text-gray-300 transition-colors flex items-center gap-1">
                                    View team pricing
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
</div>
