<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Mes Réservations ({{ $reservations->count() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($reservations->count() > 0)
                <div class="space-y-4">
                    @foreach($reservations as $reservation)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center gap-6">
                            <!-- Image -->
                            @if($reservation->logement->premierePhoto())
                            <img src="{{ asset('storage/' . $reservation->logement->premierePhoto()->chemin) }}" 
                                 alt="{{ $reservation->logement->titre }}"
                                 class="w-40 h-40 object-cover rounded-lg">
                            @else
                            <div class="w-40 h-40 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400 text-4xl">🏠</span>
                            </div>
                            @endif

                            <!-- Infos -->
                            <div class="flex-1">
                                <a href="{{ route('logement.show', $reservation->logement->id) }}" 
                                   class="font-semibold text-xl hover:text-indigo-600">
                                    {{ $reservation->logement->titre }}
                                </a>
                                <p class="text-gray-600 mt-1">{{ number_format($reservation->logement->prix, 0, ',', ' ') }} FCFA/mois</p>
                                <p class="text-gray-500 text-sm mt-1">📍 {{ $reservation->logement->ville }}</p>
                                <p class="text-gray-500 text-sm mt-2">
                                    Demandé le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                                </p>

                                @if($reservation->message_client)
                                <div class="mt-3 p-3 bg-gray-50 rounded">
                                    <p class="text-sm text-gray-600">
                                        <strong>Votre message :</strong><br>
                                        {{ $reservation->message_client }}
                                    </p>
                                </div>
                                @endif
                            </div>

                            <!-- Statut et Actions -->
                            <div class="text-right">
                                @if($reservation->statut === 'en_attente')
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                                    ⏳ En attente
                                </span>
                                <form action="{{ route('client.reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Annuler cette demande ?')"
                                            class="text-red-600 hover:text-red-800 text-sm">
                                        Annuler la demande
                                    </button>
                                </form>
                                @elseif($reservation->statut === 'acceptée')
                                <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full">
                                    ✅ Acceptée
                                </span>
                                @else
                                <span class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-4 py-2 rounded-full">
                                    ❌ Refusée
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">📋</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune réservation</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore fait de demande de réservation</p>
                    <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                        Découvrir des logements
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>