@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-4">
            <h2 class="text-xl font-semibold">Menu</h2>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('client.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Tableau de bord</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Favoris</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Réservations</a></li>
                <li>
                    <a href="#" class="flex justify-between items-center px-4 py-2 hover:bg-gray-100">
                        <span>Messages</span>
                        <span class="bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                </li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Profil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Déconnexion</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="flex-1 overflow-auto p-6">
        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-blue-500 mb-4">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux logements
        </a>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-2/3">
                    @if($logement->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $logement->images->first()->chemin) }}" 
                             alt="{{ $logement->titre }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Aucune image disponible</span>
                        </div>
                    @endif
                </div>
                <div class="p-6 md:w-1/3">
                    <h1 class="text-2xl font-bold mb-2">{{ $logement->titre }}</h1>
                    <p class="text-gray-700 text-lg mb-4">{{ $logement->adresse }}, {{ $logement->code_postal }} {{ $logement->ville }}</p>
                    
                    <div class="bg-blue-100 p-4 rounded-lg mb-6">
                        <span class="text-2xl font-bold text-blue-800">{{ number_format($logement->prix, 0, ',', ' ') }} FCFA</span>
                        <span class="text-gray-600">/ mois</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <span class="block text-gray-500">Superficie</span>
                            <span class="font-semibold">{{ $logement->superficie }} m²</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Pièces</span>
                            <span class="font-semibold">{{ $logement->nombre_pieces }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500">Capacité max</span>
                            <span class="font-semibold">{{ $logement->capacite_max }} personnes</span>
                        </div>
                    </div>

                    <button class="w-full bg-green-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-600 transition duration-200">
                        Réserver ce logement
                    </button>
                </div>
            </div>

            <div class="p-6 border-t">
                <h2 class="text-xl font-semibold mb-4">Description</h2>
                <p class="text-gray-700">{{ $logement->description }}</p>
            </div>

            <div class="p-6 border-t">
                <h2 class="text-xl font-semibold mb-4">Propriétaire</h2>
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-500">
                        {{ substr($logement->bailleur->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold">{{ $logement->bailleur->name }}</h3>
                        <p class="text-gray-600">Membre depuis {{ $logement->bailleur->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection