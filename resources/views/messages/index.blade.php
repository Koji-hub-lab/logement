<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💬 Mes Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($conversations->count() > 0)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        @foreach($conversations as $conversation)
                        @php
                            $interlocuteur = $conversation->expediteur_id === auth()->id() 
                                ? $conversation->destinataire 
                                : $conversation->expediteur;
                            $estNonLu = $conversation->destinataire_id === auth()->id() && !$conversation->lu;
                        @endphp
                        <a href="{{ route('messages.show', $interlocuteur->id) }}" 
                           class="block hover:bg-gray-50 transition {{ $estNonLu ? 'bg-blue-50' : '' }}">
                            <div class="p-6 flex items-center gap-4">
                                <!-- Avatar -->
                                <div class="w-14 h-14 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                    {{ substr($interlocuteur->prenom, 0, 1) }}{{ substr($interlocuteur->nom, 0, 1) }}
                                </div>

                                <!-- Infos -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="font-semibold text-gray-900">
                                            {{ $interlocuteur->prenom }} {{ $interlocuteur->nom }}
                                            @if($estNonLu)
                                                <span class="ml-2 inline-block w-2 h-2 bg-blue-600 rounded-full"></span>
                                            @endif
                                        </p>
                                        <span class="text-xs text-gray-500">
                                            {{ $conversation->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    @if($conversation->logement)
                                    <p class="text-sm text-gray-500 mb-1">
                                        📍 {{ $conversation->logement->titre }}
                                    </p>
                                    @endif

                                    <p class="text-sm text-gray-600 truncate">
                                        {{ $conversation->expediteur_id === auth()->id() ? 'Vous : ' : '' }}
                                        {{ $conversation->contenu }}
                                    </p>
                                </div>

                                <!-- Badge rôle -->
                                <div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $interlocuteur->role === 'bailleur' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $interlocuteur->role === 'bailleur' ? '🏠 Bailleur' : '👤 Client' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">💬</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune conversation</h3>
                    <p class="text-gray-500">Vous n'avez pas encore de messages</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>