<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Récupérer les favoris du client
        $favoris = $user->favoris()
            ->with('logement.photos')
            ->latest()
            ->take(6)
            ->get();
        
        // Récupérer les réservations récentes
        $reservations = $user->reservations()
            ->with('logement.photos')
            ->latest()
            ->take(5)
            ->get();
        
        // Compter les messages non lus
        $messagesNonLus = $user->messagesRecus()
            ->where('lu', false)
            ->count();
        
        return view('client.dashboard', compact('favoris', 'reservations', 'messagesNonLus'));
    }
}