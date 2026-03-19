<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Bailleur\DashboardController as BailleurDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logement/{id}', [HomeController::class, 'show'])->name('logement.show');

/*
|--------------------------------------------------------------------------
| Routes CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    
    // Favoris
    Route::get('/favoris', [\App\Http\Controllers\Client\FavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{logement}', [\App\Http\Controllers\Client\FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{logement}', [\App\Http\Controllers\Client\FavoriController::class, 'destroy'])->name('favoris.destroy');
    // Réservations
    Route::get('/reservations', [\App\Http\Controllers\Client\ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create/{logement}', [\App\Http\Controllers\Client\ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/{logement}', [\App\Http\Controllers\Client\ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [\App\Http\Controllers\Client\ReservationController::class, 'destroy'])->name('reservations.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes BAILLEUR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'bailleur'])->prefix('bailleur')->name('bailleur.')->group(function () {
    Route::get('/dashboard', [BailleurDashboardController::class, 'index'])->name('dashboard');
    
    // Routes pour les logements
    Route::resource('logements', \App\Http\Controllers\Bailleur\LogementController::class);
    Route::delete('/photos/{id}', [\App\Http\Controllers\Bailleur\LogementController::class, 'deletePhoto'])->name('photos.delete');
    // Gestion des demandes de réservation
    Route::get('/demandes', [\App\Http\Controllers\Bailleur\DemandeController::class, 'index'])->name('demandes.index');
    Route::post('/demandes/{reservation}/accepter', [\App\Http\Controllers\Bailleur\DemandeController::class, 'accepter'])->name('demandes.accepter');
    Route::post('/demandes/{reservation}/refuser', [\App\Http\Controllers\Bailleur\DemandeController::class, 'refuser'])->name('demandes.refuser');
});



// Messagerie (pour tous les utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
    Route::get('/logements/{logement}/contacter', [\App\Http\Controllers\MessageController::class, 'creerConversation'])->name('messages.creer');
});

/*
|--------------------------------------------------------------------------
| Routes de profil (communes)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';