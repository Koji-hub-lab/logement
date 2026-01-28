<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logement - Trouvez votre logement idéal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (!file_exists(public_path('build/manifest.json')) && !file_exists(public_path('hot')))
        <style>
            /* Fallback styles if Vite is not running */
            body { font-family: 'Figtree', sans-serif; }
            .btn-primary {
                @apply bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-medium;
            }
            .btn-outline {
                @apply border border-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-50 transition-colors font-medium;
            }
        </style>
    @endif
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section with Search -->
    <div class="bg-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">Trouvez le logement de vos rêves</h1>
                <p class="text-xl text-blue-100">Des milliers d'annonces de particuliers et d'agences</p>
            </div>
            
            <!-- Search Bar -->
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" placeholder="Ville, quartier, code postal..." class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Type de logement</option>
                            <option value="appartement">Appartement</option>
                            <option value="maison">Maison</option>
                            <option value="studio">Studio</option>
                            <option value="chambre">Chambre</option>
                        </select>
                    </div>
                    <div>
                        <button class="w-full bg-blue-800 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition-colors font-medium">
                            Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Featured Properties -->
        <section class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Annonces récentes</h2>
                <a href="#" class="text-blue-800 hover:underline">Voir tout</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Property Card 1 -->
               <a href="#" > <x-property-card 
                    image="{{ asset('images/hell.jpeg') }}"
                    title="Appartement moderne"
                    location="Paris 15e"
                    price="45000"
                    rooms="2"
                    size="45"
                /></a>

                <!-- Property Card 2 -->
               <a href="#" > <x-property-card 
                    image="{{ asset('images/lamine.jpeg') }}"
                    title="Maison avec jardin"
                    location="Lyon 3e"
                    price="780000"
                    rooms="4"
                    size="95"
                /></a>

                <!-- Property Card 3 -->
               <a href="#" > <x-property-card 
                    image="{{ asset('images/maison.jpeg') }}"
                    title="Studio meublé"
                    location="Marseille 8e"
                    price="350000"
                    rooms="1"
                    size="25"
                /></a>

                <!-- Property Card 4 -->
                <a href="#" > <x-property-card 
                    image="{{asset ('images/flick.jpeg') }}"
                    title="Appartement lumineux"
                    location="Toulouse"
                    price="750"
                    rooms="3"
                    size="65"
                /></a>
            </div>
        </section>

        <!-- How It Works -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-16">
            <h2 class="text-2xl font-bold text-center mb-12">Comment ça marche ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">1. Recherchez</h3>
                    <p class="text-gray-600">Trouvez le logement qui correspond à vos critères</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">2. Contactez</h3>
                    <p class="text-gray-600">Prenez contact avec le propriétaire ou l'agence</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">3. Déménagez</h3>
                    <p class="text-gray-600">Emménagez dans votre nouveau logement</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
     @include('components.footer')
   
</html>
