@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Recherche Avancée</h2>
                
                <!-- Formulaire de recherche avancée -->
                <form action="#" method="GET" class="space-y-6">
                    <!-- Type de logement -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type de logement</label>
                        <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Tous les types</option>
                            <option value="appartement">Appartement</option>
                            <option value="maison">Maison</option>
                            <option value="studio">Studio</option>
                            <option value="chambre">Chambre</option>
                        </select>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Localisation</label>
                        <input type="text" name="location" id="location" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ville, quartier...">
                    </div>

                    <!-- Prix -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="prix_min" class="block text-sm font-medium text-gray-700">Prix minimum (FCFA)</label>
                            <input type="number" name="prix_min" id="prix_min" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="prix_max" class="block text-sm font-medium text-gray-700">Prix maximum (FCFA)</label>
                            <input type="number" name="prix_max" id="prix_max" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Superficie -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="surface_min" class="block text-sm font-medium text-gray-700">Surface minimale (m²)</label>
                            <input type="number" name="surface_min" id="surface_min" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="surface_max" class="block text-sm font-medium text-gray-700">Surface maximale (m²)</label>
                            <input type="number" name="surface_max" id="surface_max" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Équipements -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Équipements</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center">
                                <input id="meuble" name="meuble" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <label for="meuble" class="ml-2 block text-sm text-gray-700">Meublé</label>
                            </div>
                            <div class="flex items-center">
                                <input id="climatisation" name="climatisation" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <label for="climatisation" class="ml-2 block text-sm text-gray-700">Climatisation</label>
                            </div>
                            <div class="flex items-center">
                                <input id="chauffe_eau" name="chauffe_eau" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <label for="chauffe_eau" class="ml-2 block text-sm text-gray-700">Chauffe-eau</label>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Réinitialiser
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
