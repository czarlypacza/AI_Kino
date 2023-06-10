<nav x-data="{ open: false }" class="border-b bg-p_primary-500 border-p_support-400 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-p_accent-50 dark:text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex ">
                    <x-nav-link class="no-underline" :href="route('guest_index')" :active="request()->routeIs('guest_index')">
                        {{ __('Kino') }}
                    </x-nav-link>
                </div>
                @can('is-admin')
                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex">
                    <x-nav-link class="no-underline" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @endcan
            </div>
            <div class="flex">

                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex">
                    <x-nav-link class="no-underline" :href="route('shows.index')" :active="request()->routeIs('shows.index')">
                        {{ __('Repertuar') }}
                    </x-nav-link>
                </div>
                @can('is-admin')
                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex">
                    <x-nav-link class="no-underline" :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                        {{ __('Filmy') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex">
                    <x-nav-link class="no-underline" :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
                        {{ __('Sale') }}
                    </x-nav-link>
                </div>
                @endcan
                @if (Auth::check())
                <div class="hidden space-x-4 sm:-my-px sm:ml-3 sm:flex">
                    <x-nav-link class="no-underline" :href="route('tickets.index')" :active="request()->routeIs('tickets.index')">
                        {{ __('Bilety') }}
                    </x-nav-link>
                </div>
                @endif
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border-transparent text-sm leading-4 font-medium rounded-md text-p_accent-600 dark:text-gray-400 bg-primary-400 dark:bg-gray-800 hover:text-p_accent-500 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link class="no-underline" :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link class="no-underline" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border-transparent text-sm leading-4 font-medium rounded-md text-p_accent-600 dark:text-gray-400 bg-primary-400 dark:bg-gray-800 hover:text-p_accent-500 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>Profil</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link class="no-underline" :href="route('login')">
                                    {{ __('Login') }}
                                </x-dropdown-link>


                                <x-dropdown-link class="no-underline" :href="route('register')">
                                    {{ __('Rejestracja') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-p_primary-600 dark:hover:bg-gray-900 focus:outline-none focus:bg-p_primary-400 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Logo -->
        {{--<div class="shrink-0 flex items-center pb-4">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-800" />
            </a>
        </div>--}}

        <!-- Navigation Links -->
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('guest_index')" :active="request()->routeIs('guest_index')">
                {{ __('Kino') }}
            </x-responsive-nav-link>
        </div>
        @can('is-admin')
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>
        @endcan

        <!-- Additional Links -->
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('shows.index')" :active="request()->routeIs('shows.index')">
                {{ __('Repertuar') }}
            </x-responsive-nav-link>
        </div>
        @can('is-admin')
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                    {{ __('Filmy') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
                    {{ __('Sale') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.index')">
                    {{ __('Bilety') }}
                </x-responsive-nav-link>
            </div>
        @endcan
        <!-- Settings Dropdown -->
        <div class="pt-2 pb-3 border-t border-p_support-400 dark:border-gray-700">
            @if (Auth::check())
                <div class="flex items-center px-4">
                    <div class="ml-3">
                        <div class="font-medium text-base text-p_support-300">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-p_accent-300">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Rejestracja') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>

</nav>
