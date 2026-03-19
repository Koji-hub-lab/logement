<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📨 Gestion des Demandes de Réservation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-yellow-100 rounded-lg p-6">
                    <div class="text-yellow-800">
                        <div class="text-3xl font-bold">{{ $enAttente->count() }}</div>
                        <div class="text-sm">Demandes en attente</div>
                    </div>
                </div>
                <div class="bg-green-100 rounded-lg p-6">
                    <div class="text-green-800">
                        <div class="text-3xl font-bold">{{ $acceptees->count() }}</div>
                        <div class="text-sm">Demandes acceptées</div>
                    </div>
                </div>
                <div class="bg-red-100 rounded-lg p-6">
                    <div class="text-red-800">
                        <div class="text-3xl font-bold">{{ $refusees->count() }}</div>
                        <div class="text-sm">Demandes refusées</div>
                    </div>
                </div>
            </div>

            <!-- Onglets -->
            <div x-data="{ tab: 'attente' }" class="bg-white rounded-lg shadow-md">
                <!-- Navigation des onglets -->
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button @click="tab = 'attente'" 
                                :class="tab === 'attente' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm">
                            En attente ({{ $enAttente->count() }})
                        </button>
                        <button @click="tab = 'acceptees'" 
                                :class="tab === 'acceptees' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm">
                            Acceptées ({{ $acceptees->count() }})
                        </button>
                        <button @click="tab = 'refusees'" 
                                :class="tab === 'refusees' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm">
                            Refusées ({{ $refusees->count() }})
                        </button>
                    </nav>
                </div>

                <!-- Contenu des onglets -->
                <div class="p-6">
                    <!-- En attente -->
                    <div x-show="tab === 'attente'">
                        @if($enAttente->count() > 0)
                            <div class="space-y-4">
                                @foreach($enAttente as $demande)
                                @include('bailleur.demandes._demande-card', ['demande' => $demande, 'actions' => true])
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">✅</div>
                                <p class="text-gray-500">Aucune demande en attente</p>
                            </div>
                        @endif
                    </div>

                    <!-- Acceptées -->
                    <div x-show="tab === 'acceptees'">
                        @if($acceptees->count() > 0)
                            <div class="space-y-4">
                                @foreach($acceptees as $demande)
                                @include('bailleur.demandes._demande-card', ['demande' => $demande, 'actions' => false])
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">📋</div>
                                <p class="text-gray-500">Aucune demande acceptée</p>
                            </div>
                        @endif
                    </div>

                    <!-- Refusées -->
                    <div x-show="tab === 'refusees'">
                        @if($refusees->count() > 0)
                            <div class="space-y-4">
                                @foreach($refusees as $demande)
                                @include('bailleur.demandes._demande-card', ['demande' => $demande, 'actions' => false])
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">📋</div>
                                <p class="text-gray-500">Aucune demande refusée</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>