<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour le tableau de bord client
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    
    // Recherche
    Route::get('/search', [\App\Http\Controllers\Client\DashboardController::class, 'search'])->name('search');
    Route::get('/recherche-avancee', [\App\Http\Controllers\Client\DashboardController::class, 'rechercheAvancee'])->name('recherche-avancee');
    
    // Favoris
    Route::get('/favorites', [\App\Http\Controllers\Client\DashboardController::class, 'favorites'])->name('favorites');
    
    // Réservations
    Route::get('/bookings', [\App\Http\Controllers\Client\DashboardController::class, 'bookings'])->name('bookings');
    
    // Messages
    Route::get('/messages', [\App\Http\Controllers\Client\DashboardController::class, 'messages'])->name('messages');
    
    // Profil
    Route::get('/profile', [\App\Http\Controllers\Client\DashboardController::class, 'profile'])->name('profile');
    
    // Paramètres
    Route::get('/settings', [\App\Http\Controllers\Client\DashboardController::class, 'settings'])->name('settings');

});

// Redirection de l'ancienne route vers la nouvelle
Route::get('/dashboard_client', function () {
    return redirect()->route('client.dashboard');
})->middleware(['auth'])->name('dashboard_client');

// Routes pour le tableau de bord bailleur
Route::prefix('bailleur')->name('bailleur.')->middleware(['auth'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [\App\Http\Controllers\Bailleur\DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des biens
    Route::get('/properties', [\App\Http\Controllers\Bailleur\DashboardController::class, 'properties'])->name('properties');
    Route::get('/properties/add', [\App\Http\Controllers\Bailleur\DashboardController::class, 'addProperty'])->name('properties.add');
    
    // Réservations
    Route::get('/bookings', [\App\Http\Controllers\Bailleur\DashboardController::class, 'bookings'])->name('bookings');
    
    // Messages
    Route::get('/messages', [\App\Http\Controllers\Bailleur\DashboardController::class, 'messages'])->name('messages');
    
    // Profil
    Route::get('/profile', [\App\Http\Controllers\Bailleur\DashboardController::class, 'profile'])->name('profile');
    
    // Paramètres
    Route::get('/settings', [\App\Http\Controllers\Bailleur\DashboardController::class, 'settings'])->name('settings');
});

// Redirection de l'ancienne route vers la nouvelle
Route::get('/dashboard_bailleur', function () {
    return redirect()->route('bailleur.dashboard');
})->middleware(['auth'])->name('dashboard_bailleur');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
