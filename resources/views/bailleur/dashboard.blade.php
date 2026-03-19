<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bienvenue {{ auth()->user()->prenom }} !
            </h2>
            <a href="{{ route('bailleur.logements.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                + Ajouter un Logement
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifications -->
            @if($demandesEnAttente > 0)
            <div class="mb-6 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4">
                <p class="font-bold">Vous avez {{ $demandesEnAttente }} demande(s) de réservation en attente</p>
            </div>
            @endif

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-3xl mb-2">🏠</div>
                    <div class="text-2xl font-bold">{{ $logements->count() }}</div>
                    <div class="text-sm text-gray-500">Mes logements</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-3xl mb-2">⏳</div>
                    <div class="text-2xl font-bold">{{ $demandesEnAttente }}</div>
                    <div class="text-sm text-gray-500">Demandes en attente</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-3xl mb-2">📊</div>
                    <div class="text-2xl font-bold">{{ $reservationsMois }}</div>
                    <div class="text-sm text-gray-500">Demandes ce mois</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-3xl mb-2">💬</div>
                    <div class="text-2xl font-bold">{{ $messagesNonLus }}</div>
                    <div class="text-sm text-gray-500">Messages non lus</div>
                </div>
            </div>

            <!-- Mes logements -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Mes Logements</h3>
                    
                    @if($logements->count() > 0)
                    <div class="space-y-4">
                        @foreach($logements as $logement)
                        <div class="flex items-center border rounded-lg p-4">
                            @if($logement->premierePhoto())
                            <img src="{{ asset('storage/' . $logement->premierePhoto()->chemin) }}" 
                                 alt="{{ $logement->titre }}"
                                 class="w-32 h-32 object-cover rounded">
                            @else
                            <div class="w-32 h-32 bg-gray-200 rounded flex items-center justify-center">
                                <span class="text-gray-400 text-xs">Pas d'image</span>
                            </div>
                            @endif
                            <div class="ml-4 flex-1">
                                <h4 class="font-semibold text-lg">{{ $logement->titre }}</h4>
                                <p class="text-gray-600">{{ number_format($logement->prix, 0, ',', ' ') }} FCFA/mois</p>
                                <p class="text-sm text-gray-500">{{ $logement->ville }} • {{ $logement->nb_chambres }} chambres</p>
                                <p class="text-sm text-gray-500">{{ $logement->reservations_count }} demande(s)</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $logement->statut === 'disponible' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($logement->statut) }}
                                </span>
                            </div>
                            <div class="ml-4 flex gap-2">
                                <a href="{{ route('bailleur.logements.edit', $logement->id) }}" class="text-blue-600 hover:text-blue-800">
                                    Modifier
                                </a>
                                <form action="{{ route('bailleur.logements.destroy', $logement->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce logement ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500">Vous n'avez pas encore publié de logement</p>
                    <a href="{{ route('bailleur.logements.create') }}" class="inline-block mt-4 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        Publier mon premier logement
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>