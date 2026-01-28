
@extends('auth.layout')

@section('title', 'Connexion')
@section('content')

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" required 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                   value="{{ old('email') }}" autofocus>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div>
            <div class="flex justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <input id="password" name="password" type="password" required 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Se souvenir de moi -->
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" 
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                Se souvenir de moi
            </label>
        </div>

        <!-- Bouton de connexion -->
        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Se connecter
            </button>
        </div>

        <div class="text-center text-sm text-gray-600">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Créer un compte
            </a>
        </div>
    </form>
@endsection('content')

