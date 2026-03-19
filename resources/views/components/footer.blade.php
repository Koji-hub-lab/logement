<footer class="bg-gray-800 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- À propos -->
            <div>
                <h3 class="text-lg font-semibold mb-4">🏠 AppartMe</h3>
                <p class="text-gray-400 text-sm">
                    Votre plateforme de confiance pour trouver ou proposer des logements.
                </p>
            </div>

            <!-- Liens rapides -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Accueil</a></li>
                    <li><a href="{{ route('home') }}" class="hover:text-white">Rechercher</a></li>
                    @auth
                        <li><a href="{{ route('messages.index') }}" class="hover:text-white">Messages</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Pour les utilisateurs -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Utilisateurs</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    @guest
                        <li><a href="{{ route('register') }}" class="hover:text-white">S'inscrire comme Client</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white">S'inscrire comme Bailleur</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white">Se connecter</a></li>
                    @else
                        @if(auth()->user()->estClient())
                            <li><a href="{{ route('client.favoris.index') }}" class="hover:text-white">Mes Favoris</a></li>
                            <li><a href="{{ route('client.reservations.index') }}" class="hover:text-white">Mes Réservations</a></li>
                        @else
                            <li><a href="{{ route('bailleur.logements.create') }}" class="hover:text-white">Ajouter un logement</a></li>
                            <li><a href="{{ route('bailleur.demandes.index') }}" class="hover:text-white">Mes Demandes</a></li>
                        @endif
                    @endguest
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>📧 contact@appartme.cm</li>
                    <li>📱 +237 6XX XXX XXX</li>
                    <li>📍 Yaoundé, Cameroun</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} AppartMe. Tous droits réservés.</p>
        </div>
    </div>
</footer>