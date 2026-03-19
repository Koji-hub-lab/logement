<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AppartMe - Trouvez votre logement idéal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Header / Navigation -->
    <nav class="bg-gradient-to-r from-black via-blue-900 to-black shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                        🏠 AppartMe
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->estClient())
                            <a href="{{ route('client.dashboard') }}" class="text-gray-300 hover:text-white">
                                Mon Espace
                            </a>
                        @else
                            <a href="{{ route('bailleur.dashboard') }}" class="text-gray-300 hover:text-white">
                                Mon Espace
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section avec Recherche -->
    <div class="bg-gradient-to-r from-blue-900 to-black text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4">Trouvez votre logement idéal</h1>
                <p class="text-xl">Des milliers de logements disponibles</p>
            </div>

            <!-- Barre de recherche -->
            <form method="GET" action="{{ route('home') }}" class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                            <input type="text" 
                                   name="ville" 
                                   value="{{ request('ville') }}"
                                   placeholder="Ex: Yaoundé"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix min</label>
                            <input type="number" 
                                   name="prix_min" 
                                   value="{{ request('prix_min') }}"
                                   placeholder="0"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix max</label>
                            <input type="number" 
                                   name="prix_max" 
                                   value="{{ request('prix_max') }}"
                                   placeholder="1000000"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Chambres min</label>
                            <select name="chambres" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Toutes</option>
                                <option value="1" {{ request('chambres') == 1 ? 'selected' : '' }}>1+</option>
                                <option value="2" {{ request('chambres') == 2 ? 'selected' : '' }}>2+</option>
                                <option value="3" {{ request('chambres') == 3 ? 'selected' : '' }}>3+</option>
                                <option value="4" {{ request('chambres') == 4 ? 'selected' : '' }}>4+</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('home') }}" class="px-4 py-2 text-gray-300 hover:text-white">
                            Réinitialiser
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            🔍 Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des logements -->
    <div class="relative">
        <!-- Image de fond avec effet flou -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40" 
             style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); filter: blur(2px);">
        </div>
        
        <!-- Contenu par-dessus l'image -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ $logements->total() }} logement(s) disponible(s)
            </h2>
        </div>

        @if($logements->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($logements as $logement)
                <a href="{{ route('logement.show', $logement->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <!-- Image -->
                    @if($logement->premierePhoto())
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $logement->premierePhoto()->chemin) }}" 
                             alt="{{ $logement->titre }}"
                             class="w-full h-full object-cover hover:scale-110 transition duration-300">
                    </div>
                    @else
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-4xl">🏠</span>
                    </div>
                    @endif

                    <!-- Infos -->
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 truncate">{{ $logement->titre }}</h3>
                        <p class="text-blue-600 font-bold text-xl mb-2">
                            {{ number_format($logement->prix, 0, ',', ' ') }} FCFA/mois
                        </p>
                        <p class="text-gray-600 text-sm mb-2">📍 {{ $logement->ville }}</p>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <span>🛏️ {{ $logement->nb_chambres }} ch</span>
                            <span>🚿 {{ $logement->nb_salles_bain }} sdb</span>
                            @if($logement->superficie)
                            <span>📐 {{ $logement->superficie }}m²</span>
                            @endif
                        </div>
                        <div class="mt-3 flex gap-2">
                            @if($logement->wifi)
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">📶 Wifi</span>
                            @endif
                            @if($logement->parking)
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">🅿️ Parking</span>
                            @endif
                            @if($logement->climatisation)
                            <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">❄️ Clim</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $logements->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun logement trouvé</h3>
                <p class="text-gray-500">Essayez de modifier vos critères de recherche</p>
            </div>
        @endif
    </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-4">
                    AppartMe
                </h3>
                <p class="text-gray-400 text-sm">Votre plateforme de confiance pour trouver ou proposer des logements.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Liens rapides</h3>
                <ul>
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Accueil</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Rechercher</a></li>
                    <li class="mb-2"><a href="{{ route('messages.index') }}" class="text-gray-400 hover:text-white">Messages</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Utilisateurs</h3>
                <ul>
                    <li class="mb-2"><a href="{{ route('client.favoris.index') }}" class="text-gray-400 hover:text-white">Mes Favoris</a></li>
                    <li class="mb-2"><a href="{{ route('client.reservations.index') }}" class="text-gray-400 hover:text-white">Mes Réservations</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Contact</h3>
                <ul>
                    <li class="mb-2 flex items-center">
                        <span class="mr-2">📧</span> <a href="mailto:contact@appartme.cm" class="text-gray-400 hover:text-white">contact@appartme.cm</a>
                    </li>
                    <li class="mb-2 flex items-center">
                        <span class="mr-2">📞</span> <span class="text-gray-400">+237 6XX XXX XXX</span>
                    </li>
                    <li class="mb-2 flex items-center">
                        <span class="mr-2">📍</span> <span class="text-gray-400">Yaoundé, Cameroun</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>&copy; 2024 AppartMe. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>