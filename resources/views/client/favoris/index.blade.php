<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ❤️ Mes Favoris ({{ $favoris->count() }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($favoris->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($favoris as $favori)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Image -->
                        <a href="{{ route('logement.show', $favori->logement->id) }}">
                            @if($favori->logement->premierePhoto())
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $favori->logement->premierePhoto()->chemin) }}" 
                                     alt="{{ $favori->logement->titre }}"
                                     class="w-full h-full object-cover hover:scale-110 transition duration-300">
                            </div>
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-4xl">🏠</span>
                            </div>
                            @endif
                        </a>

                        <!-- Infos -->
                        <div class="p-4">
                            <a href="{{ route('logement.show', $favori->logement->id) }}">
                                <h3 class="font-semibold text-lg mb-2 truncate hover:text-indigo-600">
                                    {{ $favori->logement->titre }}
                                </h3>
                            </a>
                            <p class="text-indigo-600 font-bold text-xl mb-2">
                                {{ number_format($favori->logement->prix, 0, ',', ' ') }} FCFA/mois
                            </p>
                            <p class="text-gray-600 text-sm mb-2">📍 {{ $favori->logement->ville }}</p>
                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
                                <span>🛏️ {{ $favori->logement->nb_chambres }} ch</span>
                                <span>🚿 {{ $favori->logement->nb_salles_bain }} sdb</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <form action="{{ route('client.favoris.destroy', $favori->logement->id) }}" 
                                      method="POST" 
                                      class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200">
                                        💔 Retirer
                                    </button>
                                </form>
                                <a href="{{ route('logement.show', $favori->logement->id) }}" 
                                   class="flex-1 bg-indigo-600 text-white text-center px-4 py-2 rounded-lg hover:bg-indigo-700">
                                    Voir
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">💔</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun favori</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore ajouté de logement à vos favoris</p>
                    <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                        Découvrir des logements
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>