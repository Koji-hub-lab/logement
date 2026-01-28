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
                    location="afanete"
                    price="45000"
                    rooms="2"
                    size="45"
                /></a>

                <!-- Property Card 2 -->
               <a href="#" > <x-property-card 
                    image="{{ asset('images/lamine.jpeg') }}"
                    title="Maison avec jardin"
                    location="aviation"
                    price="780000"
                    rooms="4"
                    size="95"
                /></a>

                <!-- Property Card 3 -->
               <a href="#" > <x-property-card 
                    image="{{ asset('images/maison.jpeg') }}"
                    title="Studio meublé"
                    location="nsole"
                    price="350000"
                    rooms="1"
                    size="25"
                /></a>

                <!-- Property Card 4 -->
                <a href="#" > <x-property-card 
                    image="{{asset ('images/flick.jpeg') }}"
                    title="Appartement lumineux"
                    location="aviation"
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
    <!-- Section Témoignages -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Ce que disent nos clients</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Témoignage 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-4">JD</div>
                    <div>
                        <h4 class="font-semibold">Jean Dupont</h4>
                        <div class="flex text-yellow-400">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"J'ai trouvé mon appartement idéal en seulement quelques jours. Service exceptionnel !"</p>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mr-4">MS</div>
                    <div>
                        <h4 class="font-semibold">Marie Simon</h4>
                        <div class="flex text-yellow-400">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"Une plateforme intuitive avec une grande variété de biens. Je recommande vivement !"</p>
            </div>
            
            <!-- Témoignage 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold mr-4">TP</div>
                    <div>
                        <h4 class="font-semibold">Thomas Petit</h4>
                        <div class="flex text-yellow-400">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-gray-300">★</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"Service client réactif et professionnel. J'ai pu visiter plusieurs biens rapidement."</p>
            </div>
        </div>
    </div>
</section>

<!-- Section À la une -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Nos coups de cœur</h2>
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Voir plus →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Carte 1 -->
            <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="relative h-64">
                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">Nouveau</span>
                    <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" 
                         alt="Appartement de luxe" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold">Appartement de luxe</h3>
                        <span class="text-blue-600 font-bold">120 000 FCFA/mois</span>
                    </div>
                    <p class="text-gray-600 mb-4">Paris 16e • 75 m² • 3 pièces</p>
                    <div class="flex items-center text-gray-500 text-sm">
                        <span class="flex items-center mr-4">🛏️ 3 chambres</span>
                        <span class="flex items-center">🛁 2 salles de bain</span>
                    </div>
                </div>
            </div>
            
            <!-- Carte 2 -->
            <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="relative h-64">
                    <span class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">Meilleur rapport qualité/prix</span>
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                         alt="Maison moderne" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold">Maison moderne avec jardin</h3>
                        <span class="text-blue-600 font-bold">250 000 FCFA/mois</span>
                    </div>
                    <p class="text-gray-600 mb-4">Lyon 3e • 120 m² • 5 pièces</p>
                    <div class="flex items-center text-gray-500 text-sm">
                        <span class="flex items-center mr-4">🛏️ 4 chambres</span>
                        <span class="flex items-center">🛁 2 salles de bain</span>
                    </div>
                </div>
            </div>
            
            <!-- Carte 3 -->
            <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="relative h-64">
                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Bon plan</span>
                    <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                         alt="Studio meublé" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold">Studio meublé moderne</h3>
                        <span class="text-blue-600 font-bold">65 000 FCFA/mois</span>
                    </div>
                    <p class="text-gray-600 mb-4">Marseille 8e • 25 m² • 1 pièce</p>
                    <div class="flex items-center text-gray-500 text-sm">
                        <span class="flex items-center mr-4">🛏️ 1 chambre</span>
                        <span class="flex items-center">🛁 1 salle de bain</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Statistiques -->
<section class="py-16 bg-blue-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Notre impact en chiffres</h2>
            <p class="text-blue-100 max-w-2xl mx-auto">Des milliers de personnes nous font confiance pour trouver leur logement idéal</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">5 000+</div>
                <p class="text-blue-100">Biens immobiliers</p>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">98%</div>
                <p class="text-blue-100">Clients satisfaits</p>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">15 000+</div>
                <p class="text-blue-100">Visites par mois</p>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">10 ans</div>
                <p class="text-blue-100">D'expérience</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Blog & Conseils -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Conseils et actualités</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Découvrez nos conseils pour réussir votre recherche immobilière</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1073&q=80" 
                     alt="Conseils achat" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-blue-600 font-semibold">Acheter</span>
                    <h3 class="text-xl font-bold my-2">10 erreurs à éviter lors de l'achat d'un bien immobilier</h3>
                    <p class="text-gray-600 text-sm mb-4">Découvrez les pièges courants et comment les éviter pour faire le bon investissement.</p>
                    <a href="#" class="text-blue-600 font-medium text-sm flex items-center">
                        Lire la suite
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Article 2 -->
            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1502672260266-37c4ad445f5f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                     alt="Conseils location" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-green-600 font-semibold">Louer</span>
                    <h3 class="text-xl font-bold my-2">Comment négocier son loyer en 2024 ?</h3>
                    <p class="text-gray-600 text-sm mb-4">Nos conseils pour négocier efficacement votre loyer et faire des économies.</p>
                    <a href="#" class="text-blue-600 font-medium text-sm flex items-center">
                        Lire la suite
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Article 3 -->
            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1600585152220-90363fe7e115?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                     alt="Conseils investissement" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-purple-600 font-semibold">Investir</span>
                    <h3 class="text-xl font-bold my-2">Les quartiers les plus prometteurs en 2024</h3>
                    <p class="text-gray-600 text-sm mb-4">Découvrez où investir pour maximiser votre rendement locatif cette année.</p>
                    <a href="#" class="text-blue-600 font-medium text-sm flex items-center">
                        Lire la suite
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                Voir tous les articles
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
</body>

    <!-- Footer -->
     @include('components.footer')
   
</html>
