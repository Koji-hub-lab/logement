@extends('auth.layout_connexion')

@section('title', 'Tableau de bord Client')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Bienvenue sur votre espace client</h1>
        <p>Vous êtes connecté en tant que {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
    </div>
</div>
@endsection