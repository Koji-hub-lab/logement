<div class="border rounded-lg p-6 {{ $demande->statut === 'en_attente' ? 'bg-yellow-50 border-yellow-200' : '' }}">
    <div class="flex gap-6">
        <!-- Image du logement -->
        <div class="flex-shrink-0">
            @if($demande->logement->premierePhoto())
            <img src="{{ asset('storage/' . $demande->logement->premierePhoto()->chemin) }}" 
                 alt="{{ $demande->logement->titre }}"
                 class="w-32 h-32 object-cover rounded-lg">
            @else
            <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                <span class="text-gray-400 text-2xl">🏠</span>
            </div>
            @endif
        </div>

        <!-- Informations -->
        <div class="flex-1">
            <!-- Logement -->
            <h3 class="font-semibold text-lg mb-1">{{ $demande->logement->titre }}</h3>
            <p class="text-gray-600 mb-3">{{ number_format($demande->logement->prix, 0, ',', ' ') }} FCFA/mois</p>

            <!-- Client -->
            <div class="mb-4 p-4 bg-white rounded-lg">
                <p class="font-semibold text-sm text-gray-700 mb-1">Demandeur</p>
                <p class="font-semibold">{{ $demande->client->prenom }} {{ $demande->client->nom }}</p>
                <p class="text-sm text-gray-600">{{ $demande->client->email }}</p>
                @if($demande->client->telephone)
                <p class="text-sm text-gray-600">📱 {{ $demande->client->telephone }}</p>
                @endif
            </div>

            <!-- Message -->
            @if($demande->message_client)
            <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-gray-700 mb-1"><strong>Message du client :</strong></p>
                <p class="text-sm text-gray-700">{{ $demande->message_client }}</p>
            </div>
            @endif

            <!-- contacter -->
            <a href="{{ route('messages.show', $demande->client->id) }}" 
          class="text-indigo-600 hover:text-indigo-800 text-sm">
           💬 Contacter le client
            </a>
            <!-- Date -->
            <p class="text-sm text-gray-500">
                Demandé le {{ $demande->created_at->format('d/m/Y à H:i') }}
            </p>
        </div>

        <!-- Actions ou Statut -->
        <div class="flex flex-col justify-between items-end">
            @if($demande->statut === 'en_attente' && $actions)
                <div class="flex flex-col gap-2">
                    <form action="{{ route('bailleur.demandes.accepter', $demande->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Accepter cette demande ?')"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 whitespace-nowrap">
                            ✅ Accepter
                        </button>
                    </form>
                    <form action="{{ route('bailleur.demandes.refuser', $demande->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Refuser cette demande ?')"
                                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 whitespace-nowrap">
                            ❌ Refuser
                        </button>
                    </form>
                </div>
            @else
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $demande->statut === 'acceptée' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $demande->statut === 'refusée' ? 'bg-red-100 text-red-800' : '' }}
                    {{ $demande->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                    @if($demande->statut === 'acceptée')
                        ✅ Acceptée
                    @elseif($demande->statut === 'refusée')
                        ❌ Refusée
                    @else
                        ⏳ En attente
                    @endif
                </span>
            @endif
        </div>
    </div>
</div>