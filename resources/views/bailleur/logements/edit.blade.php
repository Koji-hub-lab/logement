<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modifier : {{ $logement->titre }}
            </h2>
            <a href="{{ route('bailleur.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                ← Retour au dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('bailleur.logements.update', $logement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titre -->
                        <div class="mb-6">
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre du logement *
                            </label>
                            <input type="text" 
                                   name="titre" 
                                   id="titre" 
                                   value="{{ old('titre', $logement->titre) }}"
                                   required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="5"
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $logement->description) }}</textarea>
                        </div>

                        <!-- Prix -->
                        <div class="mb-6">
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                                Prix mensuel (FCFA) *
                            </label>
                            <input type="number" 
                                   name="prix" 
                                   id="prix" 
                                   value="{{ old('prix', $logement->prix) }}"
                                   min="0"
                                   step="1000"
                                   required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Adresse et Ville -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                                    Adresse complète *
                                </label>
                                <input type="text" 
                                       name="adresse" 
                                       id="adresse" 
                                       value="{{ old('adresse', $logement->adresse) }}"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ville *
                                </label>
                                <input type="text" 
                                       name="ville" 
                                       id="ville" 
                                       value="{{ old('ville', $logement->ville) }}"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Chambres, Salles de bain, Superficie -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="nb_chambres" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre de chambres *
                                </label>
                                <input type="number" 
                                       name="nb_chambres" 
                                       id="nb_chambres" 
                                       value="{{ old('nb_chambres', $logement->nb_chambres) }}"
                                       min="1"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="nb_salles_bain" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre de salles de bain *
                                </label>
                                <input type="number" 
                                       name="nb_salles_bain" 
                                       id="nb_salles_bain" 
                                       value="{{ old('nb_salles_bain', $logement->nb_salles_bain) }}"
                                       min="1"
                                       required
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="superficie" class="block text-sm font-medium text-gray-700 mb-2">
                                    Superficie (m²)
                                </label>
                                <input type="number" 
                                       name="superficie" 
                                       id="superficie" 
                                       value="{{ old('superficie', $logement->superficie) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="mb-6">
                            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                                Statut *
                            </label>
                            <select name="statut" 
                                    id="statut" 
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="disponible" {{ old('statut', $logement->statut) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="loué" {{ old('statut', $logement->statut) == 'loué' ? 'selected' : '' }}>Loué</option>
                            </select>
                        </div>

                        <!-- Équipements -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Équipements disponibles
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="wifi" 
                                           value="1"
                                           {{ old('wifi', $logement->wifi) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">📶 WiFi</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="parking" 
                                           value="1"
                                           {{ old('parking', $logement->parking) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">🅿️ Parking</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="climatisation" 
                                           value="1"
                                           {{ old('climatisation', $logement->climatisation) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">❄️ Climatisation</span>
                                </label>
                            </div>
                        </div>

                        <!-- Photos existantes -->
                        @if($logement->photos->count() > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Photos actuelles
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($logement->photos as $photo)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $photo->chemin) }}" 
                                         alt="Photo" 
                                         class="w-full h-32 object-cover rounded-lg">
                                    <form action="{{ route('bailleur.photos.delete', $photo->id) }}" 
                                          method="POST" 
                                          class="absolute top-2 right-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Supprimer cette photo ?')"
                                                class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700">
                                            ×
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Ajouter de nouvelles photos -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ajouter de nouvelles photos
                            </label>
                            <input type="file" 
                                   name="photos[]" 
                                   multiple
                                   accept="image/*"
                                   class="w-full"
                                   onchange="previewImages(event)">
                            <div id="preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('bailleur.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                Annuler
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            
            const files = event.target.files;
            
            for (let i = 0; i < Math.min(files.length, 10); i++) {
                const file = files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                        <span class="absolute top-1 right-1 bg-indigo-600 text-white text-xs px-2 py-1 rounded">Nouveau ${i + 1}</span>
                    `;
                    preview.appendChild(div);
                }
                
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>