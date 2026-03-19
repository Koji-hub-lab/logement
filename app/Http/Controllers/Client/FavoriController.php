<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function index()
    {
        $favoris = auth()->user()->favoris()
            ->with('logement.photos')
            ->latest()
            ->get();

        return view('client.favoris.index', compact('favoris'));
    }

    public function store($logementId)
    {
        $logement = Logement::findOrFail($logementId);

        // Vérifier si déjà en favori
        $existe = auth()->user()->favoris()
            ->where('logement_id', $logementId)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ce logement est déjà dans vos favoris');
        }

        auth()->user()->favoris()->create([
            'logement_id' => $logementId,
        ]);

        return back()->with('success', 'Logement ajouté aux favoris');
    }

    public function destroy($logementId)
    {
        auth()->user()->favoris()
            ->where('logement_id', $logementId)
            ->delete();

        return back()->with('success', 'Logement retiré des favoris');
    }
}