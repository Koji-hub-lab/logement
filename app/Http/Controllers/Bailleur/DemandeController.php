<?php

namespace App\Http\Controllers\Bailleur;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Notifications\ReservationStatusChanged;

class DemandeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les demandes pour les logements du bailleur
        $demandes = Reservation::whereHas('logement', function($query) {
            $query->where('user_id', auth()->id());
        })
        ->with(['client', 'logement.photos'])
        ->latest()
        ->get();

        // Grouper par statut
        $enAttente = $demandes->where('statut', 'en_attente');
        $acceptees = $demandes->where('statut', 'acceptée');
        $refusees = $demandes->where('statut', 'refusée');

        return view('bailleur.demandes.index', compact('demandes', 'enAttente', 'acceptees', 'refusees'));
    }

            public function accepter($id)
        {
            $reservation = Reservation::whereHas('logement', function($query) {
                $query->where('user_id', auth()->id());
            })->findOrFail($id);

            if ($reservation->statut !== 'en_attente') {
                return back()->with('error', 'Cette demande a déjà été traitée');
            }

            $reservation->update([
                'statut' => 'acceptée'
            ]);

            // Envoyer la notification
            $reservation->client->notify(new ReservationStatusChanged($reservation));

            return back()->with('success', 'Demande acceptée avec succès !');
        }

        public function refuser($id)
        {
            $reservation = Reservation::whereHas('logement', function($query) {
                $query->where('user_id', auth()->id());
            })->findOrFail($id);

            if ($reservation->statut !== 'en_attente') {
                return back()->with('error', 'Cette demande a déjà été traitée');
            }

            $reservation->update([
                'statut' => 'refusée'
            ]);

            // Envoyer la notification
            $reservation->client->notify(new ReservationStatusChanged($reservation));

            return back()->with('success', 'Demande refusée');
        }
}