<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demander une Réservation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 mb-6">
                <!-- Infos du logement -->
                <h3 class="text-lg font-semibold mb-4">Logement concerné</h3>
                <div class="flex items-center gap-4 mb-6">
                    @if($logement->premierePhoto())
                    <img src="{{ asset('storage/' . $logement->premierePhoto()->chemin) }}" 
                         alt="{{ $logement->titre }}"
                         class="w-32 h-32 object-cover rounded-lg">
                    @else
                    <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">🏠</span>
                    </div>
                    @endif
                    <div>
                        <h4 class="font-semibold text-xl">{{ $logement->titre }}</h4>
                        <p class="text-indigo-600 font-bold text-lg">{{ number_format($logement->prix, 0, ',', ' ') }} FCFA/mois</p>
                        <p class="text-gray-600">📍 {{ $logement->adresse }}, {{ $logement->ville }}</p>
                    </div>
                </div>

                <!-- Infos du bailleur -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold mb-2">Propriétaire</h4>
                    <p>{{ $logement->bailleur->prenom }} {{ $logement->bailleur->nom }}</p>
                    @if($logement->bailleur->email)
                    <p class="text-sm text-gray-600">{{ $logement->bailleur->email }}</p>
                    @endif
                </div>

                <!-- Formulaire -->
                <form action="{{ route('client.reservations.store', $logement->id) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="message_client" class="block text-sm font-medium text-gray-700 mb-2">
                            Message au propriétaire (optionnel)
                        </label>
                        <textarea name="message_client" 
                                  id="message_client" 
                                  rows="5"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Présentez-vous et expliquez votre demande...">{{ old('message_client') }}</textarea>
                        @error('message_client')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-blue-800">
                            <strong>Note :</strong> Votre demande sera envoyée au propriétaire. Vous recevrez une notification lorsqu'il aura répondu.
                        </p>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('logement.show', $logement->id) }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            📋 Envoyer la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>