<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AppartMe') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- En-tête noir et bleu -->
        <header class="bg-gradient-to-r from-black via-blue-900 to-black shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <!-- Logo/Titre -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="group flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="text-white text-xl font-bold group-hover:text-blue-300 transition-colors">
                                {{ config('app.name', 'AppartMe') }}
                            </span>
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="{{ url('/') }}" class="text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Accueil</span>
                        </a>
                        
                        @guest
                            <a href="{{ route('login') }}" class="text-blue-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium bg-blue-800 bg-opacity-30 transition-colors duration-200">
                                Connexion
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                Tableau de bord
                            </a>
                        @endguest
                    </nav>

                    <!-- Menu mobile (button) -->
                    <div class="md:hidden">
                        <button type="button" class="text-gray-300 hover:text-white p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
