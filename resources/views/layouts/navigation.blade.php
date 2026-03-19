<nav x-data="{ open: false }" class="bg-gradient-to-r from-black via-blue-900 to-black shadow-xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <span class="text-2xl font-bold text-white">🏠 AppartMe</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Bouton Retour -->
                    <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-600 focus:outline-none focus:bg-gray-600 focus:text-white transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour
                    </a>
                    
                    @auth
                        @if(auth()->user()->estClient())
                            <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.*')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('client.favoris.index')" :active="request()->routeIs('client.favoris.*')">
                                {{ __('Mes Favoris') }}
                            </x-nav-link>
                            <x-nav-link :href="route('client.reservations.index')" :active="request()->routeIs('client.reservations.*')">
                                {{ __('Mes Réservations') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('bailleur.dashboard')" :active="request()->routeIs('bailleur.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('bailleur.logements.create')" :active="request()->routeIs('bailleur.logements.create')">
                                {{ __('Ajouter un Logement') }}
                            </x-nav-link>
                            <x-nav-link :href="route('bailleur.demandes.index')" :active="request()->routeIs('bailleur.demandes.*')">
                                {{ __('Demandes') }}
                            </x-nav-link>
                        @endif
                        
                        <!-- Messages avec compteur -->
                        <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')">
                            💬 Messages
                            @php
                                $messagesNonLus = auth()->user()->messagesRecus()->where('lu', false)->count();
                            @endphp
                            @if($messagesNonLus > 0)
                                <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full px-2 py-1">
                                    {{ $messagesNonLus }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2">Se connecter</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">S'inscrire</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-blue-800 focus:outline-none focus:bg-blue-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900 bg-opacity-95">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->estClient())
                    <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('client.favoris.index')" :active="request()->routeIs('client.favoris.*')">
                        {{ __('Mes Favoris') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('client.reservations.index')" :active="request()->routeIs('client.reservations.*')">
                        {{ __('Mes Réservations') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('bailleur.dashboard')" :active="request()->routeIs('bailleur.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('bailleur.logements.create')" :active="request()->routeIs('bailleur.logements.create')">
                        {{ __('Ajouter un Logement') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('bailleur.demandes.index')" :active="request()->routeIs('bailleur.demandes.*')">
                        {{ __('Demandes') }}
                    </x-responsive-nav-link>
                @endif
                
                <!-- Messages avec compteur (Mobile) -->
                <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')">
                    💬 Messages
                    @php
                        $messagesNonLus = auth()->user()->messagesRecus()->where('lu', false)->count();
                    @endphp
                    @if($messagesNonLus > 0)
                        <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full px-2 py-1">
                            {{ $messagesNonLus }}
                        </span>
                    @endif
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-blue-700">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
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
            </div>
        @endauth
    </div>
</nav>