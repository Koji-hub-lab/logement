<?php

namespace App\Http\Controllers\Bailleur;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Récupérer les logements du bailleur
        $logements = $user->logements()
            ->withCount('reservations')
            ->with('photos')
            ->latest()
            ->get();
        
        // Compter les demandes en attente
        $demandesEnAttente = Reservation::whereHas('logement', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('statut', 'en_attente')->count();
        
        // Compter les messages non lus
        $messagesNonLus = $user->messagesRecus()
            ->where('lu', false)
            ->count();
        
        // Statistiques du mois
        $reservationsMois = Reservation::whereHas('logement', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereMonth('created_at', now()->month)->count();
        
        return view('bailleur.dashboard', compact(
            'logements', 
            'demandesEnAttente', 
            'messagesNonLus',
            'reservationsMois'
        ));
    }
}