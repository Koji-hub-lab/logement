<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenue {{ auth()->user()->prenom }} !
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifications -->
            @if($messagesNonLus > 0)
            <div class="mb-6 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                <p class="font-bold">Vous avez {{ $messagesNonLus }} nouveau(x) message(s)</p>
            </div>
            @endif

            <!-- Actions rapides -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <a href="{{ route('home') }}" class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-center hover:bg-gray-50">
                    <div class="text-3xl mb-2">🔍</div>
                    <div class="font-semibold">Rechercher</div>
                </a>
                <a href="{{ route('client.favoris.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-center hover:bg-gray-50">
                <div class="text-3xl mb-2">❤️</div>
                <div class="font-semibold">Mes Favoris</div>
                <div class="text-sm text-gray-500">{{ $favoris->count() }}</div>
                </a>
                <a href="{{ route('client.reservations.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-center hover:bg-gray-50">
                <div class="text-3xl mb-2">📋</div>
                <div class="font-semibold">Mes Réservations</div>
                <div class="text-sm text-gray-500">{{ $reservations->count() }}</div>
                </a>
                <a href="{{ route('messages.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-center hover:bg-gray-50">
                <div class="text-3xl mb-2">💬</div>
                <div class="font-semibold">Messages</div>
                @if($messagesNonLus > 0)
                <div class="text-sm text-red-500">{{ $messagesNonLus }} non lu(s)</div>
                @endif
                </a>
            </div>

            <!-- Mes favoris récents -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Mes Favoris Récents</h3>
                    
                    @if($favoris->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($favoris as $favori)
                        <div class="border rounded-lg overflow-hidden">
                            @if($favori->logement->premierePhoto())
                            <img src="{{ asset('storage/' . $favori->logement->premierePhoto()->chemin) }}" 
                                 alt="{{ $favori->logement->titre }}"
                                 class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">Pas d'image</span>
                            </div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-semibold">{{ $favori->logement->titre }}</h4>
                                <p class="text-gray-600">{{ number_format($favori->logement->prix, 0, ',', ' ') }} FCFA/mois</p>
                                <p class="text-sm text-gray-500">{{ $favori->logement->ville }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500">Vous n'avez pas encore de favoris</p>
                    @endif
                </div>
            </div>

            <!-- Mes réservations récentes -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Mes Réservations Récentes</h3>
                    
                    @if($reservations->count() > 0)
                    <div class="space-y-4">
                        @foreach($reservations as $reservation)
                        <div class="flex items-center border rounded-lg p-4">
                            @if($reservation->logement->premierePhoto())
                            <img src="{{ asset('storage/' . $reservation->logement->premierePhoto()->chemin) }}" 
                                 alt="{{ $reservation->logement->titre }}"
                                 class="w-24 h-24 object-cover rounded">
                            @else
                            <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400 text-xs">Pas d'image</span>
                            </div>
                            @endif
                            <div class="ml-4 flex-1">
                                <h4 class="font-semibold">{{ $reservation->logement->titre }}</h4>
                                <p class="text-sm text-gray-600">{{ $reservation->logement->ville }}</p>
                                <p class="text-sm text-gray-500">Demandé le {{ $reservation->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                @if($reservation->statut === 'en_attente')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">En attente</span>
                                @elseif($reservation->statut === 'acceptée')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Acceptée</span>
                                @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Refusée</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500">Vous n'avez pas encore fait de demande de réservation</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>