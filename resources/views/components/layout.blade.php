<!doctype html>
<html lang="en" class="h-full bg-[#eef3ef] text-slate-800">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pet Sitting App') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
<div class="min-h-full">

    <!-- NAV -->
    <nav class="bg-[#8fae9b]/90 backdrop-blur shadow-lg border-b-4 border-white/60">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- LEFT SIDE -->
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img class="h-9 w-9 rounded-full ring-2 ring-white/70 shadow"
                             src="{{ asset('images/profile-icon2.png') }}" alt="Logo" />
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>

                            <x-nav-link :href="route('pet-sitting.index')" :active="request()->routeIs('pet-sitting.*')">
                                Pet Sitting
                            </x-nav-link>

                            <x-nav-link :href="route('adoption')" :active="request()->routeIs('adoption')">
                                Adoption
                            </x-nav-link>

                            <x-nav-link :href="route('match')" :active="request()->routeIs('match')">
                                Match Me
                            </x-nav-link>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center space-x-4">

                        @auth
                            <div class="text-white text-sm">
                                {{ Auth::user()->name }}
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="text-white hover:text-[#eef3ef] underline text-sm">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-white hover:text-[#eef3ef] text-sm underline">
                                Login
                            </a>

                            <a href="{{ route('register') }}"
                               class="text-white hover:text-[#eef3ef] text-sm underline">
                                Register
                            </a>
                        @endauth

                    </div>
                </div>

                <!-- MOBILE BUTTON -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button"
                            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                            class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-white/20">
                        ☰
                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobile-menu" class="hidden md:hidden px-2 pb-3 space-y-1">

            <a href="{{ route('home') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-white/20">
                Home
            </a>

            <a href="{{ route('pet-sitting.index') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-white/20">
                Pet Sitting
            </a>

            <a href="{{ route('adoption') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-white/20">
                Adoption
            </a>

            <a href="{{ route('match') }}"
               class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-white/20">
                Match Me
            </a>

            <div class="border-t border-white/40 pt-4">
                @auth
                    <div class="px-3 text-white text-sm">
                        {{ Auth::user()->name }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="px-3 mt-2">
                        @csrf
                        <button type="submit"
                                class="text-white underline text-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <div class="px-3 space-y-2">
                        <a href="{{ route('login') }}" class="block text-white underline text-sm">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="block text-white underline text-sm">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="relative bg-gradient-to-b from-[#8fae9b] to-[#eef3ef] shadow-md border-b-2 border-white/60">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                {{ $heading ?? '' }}
            </h1>
        </div>
    </header>

    <!-- MAIN -->
    <main class="bg-gradient-to-b from-[#eef3ef] to-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

</div>
</body>
</html>
