<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                
                <a href="{{ asset('images/hell.jpeg') }}" class="text-2xl font-bold text-blue-800">AppartMe</a>
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">Accueil</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">Explorer</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">À propos</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">Contact</a>
            </nav>
            
            <!-- Boutons d'authentification -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Se connecter</a>
                <a href="{{ route('register') }}" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">S'inscrire</a>
            </div>
        </div>
    </div>
</header>
