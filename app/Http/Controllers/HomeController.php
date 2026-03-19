<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Logement::with(['photos', 'bailleur'])
            ->where('statut', 'disponible');

        // Recherche par ville
        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        // Filtre par prix minimum
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }

        // Filtre par prix maximum
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        // Filtre par nombre de chambres
        if ($request->filled('chambres')) {
            $query->where('nb_chambres', '>=', $request->chambres);
        }

        $logements = $query->latest()->paginate(12);

        return view('welcome', compact('logements'));
    }

    public function show($id)
    {
        $logement = Logement::with(['photos', 'bailleur'])->findOrFail($id);
        
        // Vérifier si c'est un favori (si connecté)
        $estFavori = false;
        if (auth()->check() && auth()->user()->estClient()) {
            $estFavori = auth()->user()->favoris()
                ->where('logement_id', $id)
                ->exists();
        }

        return view('logements.show', compact('logement', 'estFavori'));
    }
}