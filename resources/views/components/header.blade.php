<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-800">AppartMe</a>
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Accueil</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">Explorer</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">À propos</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2">Contact</a>
            </nav>
            
            <!-- Boutons d'authentification -->
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('client.dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Tableau de bord</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Se connecter</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">S'inscrire</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>