<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        @include('partials.head')

        @stack('styles')
        <style>
        [data-flux-sidebar] [data-flux-profile],
        [data-flux-sidebar] [data-flux-profile] *,
        [data-flux-sidebar] [data-flux-profile] span,
        [data-flux-sidebar] [data-flux-profile] div {
            color: white !important;
        }

        [data-flux-sidebar] [data-flux-profile] svg,
        [data-flux-sidebar] [data-flux-profile] svg * {
            color: white !important;
        }

        [data-flux-sidebar] [data-flux-profile]:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        [data-flux-sidebar] [data-flux-profile] [data-flux-badge] {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }
        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="w-80 bg-[#5170ff] border-e border-[#5170ff] text-white" data-test="sidebar">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <img src="{{ asset('assets/images/GoodTrav.png') }}" alt="Logo" class="w-full h-auto" />
            </a>

            <br/>
            <br/>


            <nav class="px-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }}"
                   wire:navigate>
                    <span class="text-base font-medium montserrat-bold">Home</span>
                </a>

                <br/>


                <a href="{{ route('study') }}"
                   class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('study') ? 'bg-white/20' : '' }}"
                   >
                    <span class="text-base font-medium montserrat-bold">Study</span>
                </a>

                <br/>

                <a href="{{ route('points') }}"
                   class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('points') ? 'bg-white/20' : '' }}"
                   wire:navigate>
                    <span class="text-base font-medium montserrat-bold">GT Points</span>
                </a>

                <br/>

                <a href="{{ route('trips') }}"
                   class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('trips') || request()->routeIs('trip.detail') ? 'bg-white/20' : '' }}"
                   wire:navigate>
                    <span class="text-base font-medium montserrat-bold">Trips</span>
                </a>

                <br/>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('profile.edit') || request()->routeIs('billing') ||  request()->routeIs('user-password.edit') ? 'bg-white/20' : '' }}"
                   wire:navigate>
                    <span class="text-base font-medium montserrat-bold">Info & Help</span>
                </a>

                <br/>

                <a href="{{ route('society') }}"
                class="flex items-center px-4 py-3 rounded-lg bg-white hover:bg-white transition-colors {{ request()->routeIs('society') ? 'bg-white' : '' }}"
                wire:navigate>
                    <span class="text-2xl font-extrabold bg-gradient-to-br from-pink-500 to-orange-400 bg-clip-text text-transparent poppins-extrabold">
                        GoodTrav Society
                    </span>
                </a>

            </nav>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="top" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-white text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>


                    @if(auth()->check() && auth()->user()->canAccessPanel(app(\Filament\Panel::class)))
                        <flux:menu.item :href="route('filament.admin.pages.dashboard')" icon="arrow-right-end-on-rectangle" target="_blank">
                            {{ __('Panel Administrador') }}
                        </flux:menu.item>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full cursor-pointer" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts

        @stack('scripts')
    </body>
</html>
