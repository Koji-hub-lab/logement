<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de bord Client - {{ config('app.name', 'Logement') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Scripts Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- En-tête -->
    @include('components.header')

    <div class="min-h-screen">
        <!-- Barre de navigation du tableau de bord -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-900">
                            Tableau de bord Client
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Bouton de notification -->
                        <button type="button" class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="sr-only">Voir les notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        
                        <!-- Menu utilisateur -->
                        <div class="relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Ouvrir le menu utilisateur</span>
                                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
                                    </div>
                                </button>
                            </div>

                            <!-- Menu déroulant -->
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="{{ route('client.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Mon Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="py-10">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Bonjour, {{ Auth::user()->prenom }} !
                    </h1>
                    <p class="mt-2 text-gray-600">Bienvenue sur votre espace personnel</p>
                </div>
            </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Navigation rapide -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
            <a href="{{ route('client.recherche-avancee') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow flex flex-col items-center justify-center text-center">
                <div class="bg-blue-100 p-3 rounded-full mb-2">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <span class="text-sm font-medium">Rechercher un logement</span>
            </a>
            <a href="{{ route('client.favorites') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow flex flex-col items-center justify-center text-center">
                <div class="bg-red-100 p-3 rounded-full mb-2">
                    <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-medium">Mes Favoris</span>
            </a>
            <a href="{{ route('client.bookings') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow flex flex-col items-center justify-center text-center">
                <div class="bg-green-100 p-3 rounded-full mb-2">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-sm font-medium">Mes Réservations</span>
            </a>
            <a href="{{ route('client.messages') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow flex flex-col items-center justify-center text-center">
                <div class="bg-purple-100 p-3 rounded-full mb-2 relative">
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">2</span>
                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <span class="text-sm font-medium">Messages</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow flex flex-col items-center justify-center text-center">
                <div class="bg-yellow-100 p-3 rounded-full mb-2">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-sm font-medium">Mon Profil</span>
            </a>
        </div>

        <!-- Barre de recherche -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex">
                <input type="text" placeholder="Rechercher un logement..." class="flex-1 rounded-l-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-lg transition-colors">
                    Rechercher
                </button>
            </div>
            <div class="mt-4 flex space-x-4">
                <select class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option>Tous les types</option>
                    <option>Appartement</option>
                    <option>Maison</option>
                    <option>studio</option>
                    <option>chambre</option>
                </select>
                <select class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option>Tous les quartier</option>
                    <option>nsole</option>
                    <option>Aviation</option>
                    <option>Afanete</option>
                </select>
                <input type="number" placeholder="Prix max" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2 w-32">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Section Favoris -->
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold flex items-center">
                            <svg class="h-6 w-6 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            Mes logements favoris
                        </h2>
                        <a href="{{ route('client.favorites') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            Voir tout
                            <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Carte de logement favori -->
                        <div class="border rounded-lg overflow-hidden">
                            <div class="h-40 bg-gray-200 relative">
                                <button class="absolute top-2 right-2 text-red-500">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold">Appartement moderne</h3>
                                <p class="text-gray-600 text-sm">Afanete</p>
                                <p class="font-semibold text-gray-900 mt-1">85 000 FCFA/mois</p>
                            </div>
                        </div>
                        <!-- Ajoutez plus de cartes de logements favoris ici -->
                    </div>
                </div>
            </div>

            <!-- Section Réservations -->
            <div>
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Mes réservations
                        </h2>
                        <a href="{{ route('client.bookings') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            Voir tout
                            <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="space-y-4">
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">En attente de validation</p>
                                    <p class="text-sm text-gray-600">Appartement moderne - Afanete</p>
                                    <p class="text-xs text-gray-500 mt-1">Demandé le 24/01/2026</p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">En cours</span>
                            </div>
                        </div>
                        <div class="border-l-4 border-green-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">Réservation confirmée</p>
                                    <p class="text-sm text-gray-600">Studio cosy - Nsole</p>
                                    <p class="text-xs text-gray-500 mt-1">Confirmé le 20/01/2026</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Validé</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('client.bookings') }}" class="block text-center text-blue-600 hover:text-blue-800 mt-4 text-sm font-medium flex items-center justify-center">
                        Voir toutes mes réservations
                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Section Messages -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold flex items-center">
                            <svg class="h-6 w-6 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            Messages
                        </h2>
                        <span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">2</span>
                    </div>
                    <div class="space-y-3">
                        <a href="{{ route('client.messages') }}" class="block hover:bg-gray-50 -mx-2 px-2 py-1 rounded">
                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold flex-shrink-0">
                                    JD
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between">
                                        <p class="font-medium text-gray-900">Jean D.</p>
                                        <span class="text-xs text-gray-500">10:30</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">Bonjour, je suis intéressé par votre logement...</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('client.messages') }}" class="block hover:bg-gray-50 -mx-2 px-2 py-1 rounded">
                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-semibold flex-shrink-0">
                                    ML
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between">
                                        <p class="font-medium text-gray-900">Marie L.</p>
                                        <span class="text-xs text-gray-500">Hier</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">Merci pour votre visite, quand souhaitez-vous...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="{{ route('client.messages') }}" class="block text-center text-blue-600 hover:text-blue-800 mt-4 text-sm font-medium flex items-center justify-center">
                        Voir tous les messages
                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
            </main>
    </div>

    <!-- Pied de page -->
    @include('components.footer')

    <!-- Script pour le menu utilisateur -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open
                }
            }))
        })
    </script>
</body>
</html>
