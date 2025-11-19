<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 ">
                    <img src="{{ asset('assets/images/bg_auth.png') }}" alt="GoodTrav" class="absolute inset-0 h-full w-full object-cover opacity-80" />
                </div>
                <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-40 w-40 items-center justify-center rounded-md">
                        @php
                            $settings = \App\Models\Setting::first();
                            $logoPath = $settings && $settings->image_path_authentication ? asset('storage/' . $settings->image_path_authentication) : asset('assets/images/GoodTrav.png');
                        @endphp
                        <img src="{{ $logoPath }}" alt="goodtrav logo" class="w-full h-auto" />
                    </span>
                </a>

                @php
                    $message = "Sin emoción no hay aprendizaje" ;
                    $author = "Francisco Mora, doctor en Neurociencia"
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2 ">
                        <flux:heading  class="text-white poppins-bold" size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading class="text-white montserrat-medium">{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-40 w-40 items-center justify-center rounded-md">
                            <img src="{{ asset('assets/images/GoodTrav.png') }}" alt="goodtrav logo" class="w-full h-auto" />
                        </span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
