<?php

namespace App\Http\Controllers\Bailleur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord bailleur
     */
    public function index()
    {
        return view('bailleur.dashboard');
    }

    /**
     * Afficher les biens du bailleur
     */
    public function properties()
    {
        return view('bailleur.properties');
    }

    /**
     * Afficher les réservations reçues
     */
    public function bookings()
    {
        return view('bailleur.bookings');
    }

    /**
     * Afficher les messages
     */
    public function messages()
    {
        return view('bailleur.messages');
    }

    /**
     * Afficher le profil du bailleur
     */
    public function profile()
    {
        return view('bailleur.profile');
    }

    /**
     * Afficher les paramètres
     */
    public function settings()
    {
        return view('bailleur.settings');
    }

    /**
     * Afficher le formulaire d'ajout d'un bien
     */
    public function addProperty()
    {
        return view('bailleur.add-property');
    }
}
