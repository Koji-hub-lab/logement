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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-gradient-to-r from-black via-blue-900 to-black shadow-xl">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-white">{{ $header }}</h2>
            </div>
        </header>
        @endisset

        <!-- Messages Flash -->
        <div class="fixed top-4 right-4 z-50 space-y-2" x-data="{ show: true }">
            @if(session('success'))
            <div x-show="show" 
                x-init="setTimeout(() => show = false, 5000)"
                class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                    ×
                </button>
            </div>
            @endif

            @if(session('error'))
            <div x-show="show" 
                x-init="setTimeout(() => show = false, 5000)"
                class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                    ×
                </button>
            </div>
            @endif
        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
<x-footer />
</body>
</html>