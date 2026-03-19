<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()
            ->with('logement.photos')
            ->latest()
            ->get();

        return view('client.reservations.index', compact('reservations'));
    }

    public function create($logementId)
    {
        $logement = Logement::with('photos', 'bailleur')->findOrFail($logementId);

        // Vérifier si une demande existe déjà
        $demandeExiste = auth()->user()->reservations()
            ->where('logement_id', $logementId)
            ->whereIn('statut', ['en_attente', 'acceptée'])
            ->exists();

        if ($demandeExiste) {
            return redirect()->route('client.reservations.index')
                ->with('error', 'Vous avez déjà une demande en cours pour ce logement');
        }

        return view('client.reservations.create', compact('logement'));
    }

    public function store(Request $request, $logementId)
    {
        $request->validate([
            'message_client' => 'nullable|string|max:1000',
        ]);

        $logement = Logement::findOrFail($logementId);

        // Vérifier à nouveau
        $demandeExiste = auth()->user()->reservations()
            ->where('logement_id', $logementId)
            ->whereIn('statut', ['en_attente', 'acceptée'])
            ->exists();

        if ($demandeExiste) {
            return redirect()->route('client.reservations.index')
                ->with('error', 'Vous avez déjà une demande en cours pour ce logement');
        }

        Reservation::create([
            'logement_id' => $logementId,
            'client_id' => auth()->id(),
            'message_client' => $request->message_client,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('client.reservations.index')
            ->with('success', 'Votre demande de réservation a été envoyée avec succès !');
    }

    public function destroy($id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);

        // On peut annuler seulement si en attente
        if ($reservation->statut !== 'en_attente') {
            return back()->with('error', 'Vous ne pouvez pas annuler cette réservation');
        }

        $reservation->delete();

        return back()->with('success', 'Demande annulée avec succès');
    }
}