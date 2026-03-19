<?php

namespace App\Http\Controllers\Bailleur;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LogementController extends Controller
{
    public function index()
    {
        $logements = auth()->user()->logements()
            ->withCount('reservations')
            ->with('photos')
            ->latest()
            ->get();

        return view('bailleur.logements.index', compact('logements'));
    }

    public function create()
    {
        return view('bailleur.logements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'nb_chambres' => 'required|integer|min:1',
            'nb_salles_bain' => 'required|integer|min:1',
            'superficie' => 'nullable|numeric|min:0',
            'wifi' => 'boolean',
            'parking' => 'boolean',
            'climatisation' => 'boolean',
            'photos.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120', // Max 5MB
        ]);

        // Créer le logement
        $logement = auth()->user()->logements()->create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'adresse' => $validated['adresse'],
            'ville' => $validated['ville'],
            'nb_chambres' => $validated['nb_chambres'],
            'nb_salles_bain' => $validated['nb_salles_bain'],
            'superficie' => $validated['superficie'],
            'wifi' => $request->has('wifi'),
            'parking' => $request->has('parking'),
            'climatisation' => $request->has('climatisation'),
            'statut' => 'disponible',
        ]);

        // Upload des photos
        if ($request->hasFile('photos')) {
            $manager = new ImageManager(new Driver());
            
            foreach ($request->file('photos') as $index => $photo) {
                // Générer un nom unique
                $filename = time() . '_' . $index . '.' . $photo->getClientOriginalExtension();
                
                // Redimensionner et sauvegarder
                $image = $manager->read($photo);
                $image->scale(width: 1200);
                
                // Sauvegarder dans storage/app/public/logements
                $path = 'logements/' . $filename;
                Storage::disk('public')->put($path, $image->encode());

                // Enregistrer dans la base de données
                $logement->photos()->create([
                    'chemin' => $path,
                    'ordre' => $index,
                ]);
            }
        }

        return redirect()
            ->route('bailleur.dashboard')
            ->with('success', 'Logement publié avec succès !');
    }

    public function edit($id)
    {
        $logement = auth()->user()->logements()->findOrFail($id);
        return view('bailleur.logements.edit', compact('logement'));
    }

    public function update(Request $request, $id)
    {
        $logement = auth()->user()->logements()->findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'nb_chambres' => 'required|integer|min:1',
            'nb_salles_bain' => 'required|integer|min:1',
            'superficie' => 'nullable|numeric|min:0',
            'statut' => 'required|in:disponible,loué',
            'wifi' => 'boolean',
            'parking' => 'boolean',
            'climatisation' => 'boolean',
            'photos.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        $logement->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'adresse' => $validated['adresse'],
            'ville' => $validated['ville'],
            'nb_chambres' => $validated['nb_chambres'],
            'nb_salles_bain' => $validated['nb_salles_bain'],
            'superficie' => $validated['superficie'],
            'statut' => $validated['statut'],
            'wifi' => $request->has('wifi'),
            'parking' => $request->has('parking'),
            'climatisation' => $request->has('climatisation'),
        ]);

        // Ajouter de nouvelles photos si fournies
        if ($request->hasFile('photos')) {
            $manager = new ImageManager(new Driver());
            $currentPhotosCount = $logement->photos()->count();
            
            foreach ($request->file('photos') as $index => $photo) {
                $filename = time() . '_' . ($currentPhotosCount + $index) . '.' . $photo->getClientOriginalExtension();
                
                $image = $manager->read($photo);
                $image->scale(width: 1200);
                
                $path = 'logements/' . $filename;
                Storage::disk('public')->put($path, $image->encode());

                $logement->photos()->create([
                    'chemin' => $path,
                    'ordre' => $currentPhotosCount + $index,
                ]);
            }
        }

        return redirect()
            ->route('bailleur.dashboard')
            ->with('success', 'Logement modifié avec succès !');
    }

    public function destroy($id)
    {
        $logement = auth()->user()->logements()->findOrFail($id);

        // Supprimer les photos du stockage
        foreach ($logement->photos as $photo) {
            Storage::disk('public')->delete($photo->chemin);
        }

        // Supprimer le logement (les photos seront supprimées automatiquement grâce à onDelete('cascade'))
        $logement->delete();

        return redirect()
            ->route('bailleur.dashboard')
            ->with('success', 'Logement supprimé avec succès !');
    }

    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);
        
        // Vérifier que c'est bien une photo du bailleur connecté
        if ($photo->logement->user_id !== auth()->id()) {
            abort(403);
        }

        // Supprimer du stockage
        Storage::disk('public')->delete($photo->chemin);
        
        // Supprimer de la base de données
        $photo->delete();

        return back()->with('success', 'Photo supprimée avec succès !');
    }
}