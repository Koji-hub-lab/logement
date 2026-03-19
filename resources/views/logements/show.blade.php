<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $logement->titre }} - AppartMe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">
                        🏠 AppartMe
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->estClient())
                            <a href="{{ route('client.dashboard') }}" class="text-gray-700 hover:text-indigo-600">
                                Mon Espace
                            </a>
                        @else
                            <a href="{{ route('bailleur.dashboard') }}" class="text-gray-700 hover:text-indigo-600">
                                Mon Espace
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Bouton retour -->
        <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6">
            ← Retour aux logements
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne principale -->
            <div class="lg:col-span-2">
                <!-- Galerie de photos -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    @if($logement->photos->count() > 0)
                        <!-- Photo principale -->
                        <div class="h-96 overflow-hidden">
                            <img id="mainPhoto" 
                                 src="{{ asset('storage/' . $logement->photos->first()->chemin) }}" 
                                 alt="{{ $logement->titre }}"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Miniatures -->
                        @if($logement->photos->count() > 1)
                        <div class="grid grid-cols-4 gap-2 p-4">
                            @foreach($logement->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->chemin) }}" 
                                 alt="Photo {{ $loop->iteration }}"
                                 class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75"
                                 onclick="document.getElementById('mainPhoto').src = this.src">
                            @endforeach
                        </div>
                        @endif
                    @else
                        <div class="h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 text-6xl">🏠</span>
                        </div>
                    @endif
                </div>

                <!-- Informations détaillées -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h1 class="text-3xl font-bold mb-4">{{ $logement->titre }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-3xl font-bold text-indigo-600">
                            {{ number_format($logement->prix, 0, ',', ' ') }} FCFA
                        </span>
                        <span class="text-gray-500">/ mois</span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl mb-2">🛏️</div>
                            <div class="font-semibold">{{ $logement->nb_chambres }}</div>
                            <div class="text-sm text-gray-500">Chambre(s)</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl mb-2">🚿</div>
                            <div class="font-semibold">{{ $logement->nb_salles_bain }}</div>
                            <div class="text-sm text-gray-500">Salle(s) de bain</div>
                        </div>
                        @if($logement->superficie)
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl mb-2">📐</div>
                            <div class="font-semibold">{{ $logement->superficie }}m²</div>
                            <div class="text-sm text-gray-500">Superficie</div>
                        </div>
                        @endif
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl mb-2">📍</div>
                            <div class="font-semibold">{{ $logement->ville }}</div>
                            <div class="text-sm text-gray-500">Localisation</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-3">Équipements</h2>
                        <div class="flex flex-wrap gap-2">
                            @if($logement->wifi)
                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full">📶 WiFi</span>
                            @endif
                            @if($logement->parking)
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full">🅿️ Parking</span>
                            @endif
                            @if($logement->climatisation)
                            <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full">❄️ Climatisation</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-3">Description</h2>
                        <p class="text-gray-700 whitespace-pre-line">{{ $logement->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <h2 class="text-xl font-semibold mb-3">Adresse</h2>
                        <p class="text-gray-700">📍 {{ $logement->adresse }}, {{ $logement->ville }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Informations du bailleur -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">Propriétaire</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($logement->bailleur->prenom, 0, 1) }}{{ substr($logement->bailleur->nom, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <div class="font-semibold">{{ $logement->bailleur->prenom }} {{ $logement->bailleur->nom }}</div>
                            <div class="text-sm text-gray-500">Bailleur</div>
                        </div>
                    </div>
                    
                    @auth
                        @if(auth()->user()->estClient())
                        <a href="{{ route('messages.creer', $logement->id) }}" 
   class="block w-full bg-indigo-600 text-white text-center px-4 py-2 rounded-lg hover:bg-indigo-700 mb-2">
    💬 Contacter le bailleur
</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-indigo-600 text-white text-center px-4 py-2 rounded-lg hover:bg-indigo-700 mb-2">
                            💬 Contacter
                        </a>
                    @endauth
                </div>

                <!-- Actions (pour les clients connectés) -->
                @auth
                    @if(auth()->user()->estClient())
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Actions rapides</h3>
                        
                        <!-- Favori -->
                        @if($estFavori)
                        <form action="{{ route('client.favoris.destroy', $logement->id) }}" method="POST" class="mb-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200">
                                💔 Retirer des favoris
                            </button>
                        </form>
                        @else
                        <form action="{{ route('client.favoris.store', $logement->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="w-full bg-pink-100 text-pink-700 px-4 py-2 rounded-lg hover:bg-pink-200">
                                ❤️ Ajouter aux favoris
                            </button>
                        </form>
                        @endif

                        <!-- Réservation -->
                        <!-- Réservation -->
                        <a href="{{ route('client.reservations.create', $logement->id) }}" 
                        class="block w-full bg-green-600 text-white text-center px-4 py-2 rounded-lg hover:bg-green-700">
                            📋 Demander une réservation
                        </a>
                    </div>
                    @endif
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <p class="text-blue-800 mb-4">Connectez-vous pour ajouter aux favoris ou faire une demande de réservation</p>
                        <a href="{{ route('login') }}" class="block w-full bg-indigo-600 text-white text-center px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Se connecter
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>