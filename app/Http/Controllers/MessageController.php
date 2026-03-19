<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer toutes les conversations (groupées par interlocuteur)
        $conversations = Message::where('expediteur_id', $user->id)
            ->orWhere('destinataire_id', $user->id)
            ->with(['expediteur', 'destinataire', 'logement'])
            ->latest()
            ->get()
            ->groupBy(function($message) use ($user) {
                // Grouper par l'ID de l'autre personne
                return $message->expediteur_id === $user->id 
                    ? $message->destinataire_id 
                    : $message->expediteur_id;
            })
            ->map(function($messages) {
                return $messages->first(); // Prendre le message le plus récent de chaque conversation
            });

        return view('messages.index', compact('conversations'));
    }

    public function show($userId)
    {
        $user = auth()->user();
        $interlocuteur = User::findOrFail($userId);

        // Récupérer tous les messages entre les deux utilisateurs
        $messages = Message::where(function($query) use ($user, $userId) {
            $query->where('expediteur_id', $user->id)
                  ->where('destinataire_id', $userId);
        })
        ->orWhere(function($query) use ($user, $userId) {
            $query->where('expediteur_id', $userId)
                  ->where('destinataire_id', $user->id);
        })
        ->with(['expediteur', 'destinataire', 'logement'])
        ->orderBy('created_at', 'asc')
        ->get();

        // Marquer les messages reçus comme lus
        Message::where('expediteur_id', $userId)
            ->where('destinataire_id', $user->id)
            ->where('lu', false)
            ->update(['lu' => true]);

        return view('messages.show', compact('interlocuteur', 'messages'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
            'logement_id' => 'nullable|exists:logements,id',
        ]);

        $destinataire = User::findOrFail($userId);

        Message::create([
            'expediteur_id' => auth()->id(),
            'destinataire_id' => $userId,
            'logement_id' => $request->logement_id,
            'contenu' => $request->contenu,
            'lu' => false,
        ]);

        return back()->with('success', 'Message envoyé');
    }

    // Démarrer une conversation depuis un logement
    public function creerConversation($logementId)
    {
        $logement = \App\Models\Logement::with('bailleur')->findOrFail($logementId);

        // Rediriger vers la conversation avec le bailleur
        return redirect()->route('messages.show', $logement->user_id)
            ->with('logement_id', $logementId);
    }
}