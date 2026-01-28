<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord client
     */
    public function index()
    {
        return view('client.dashboard');
    }

    /**
     * Afficher les favoris du client
     */
    public function favorites()
    {
        return view('client.favorites');
    }

    /**
     * Afficher les réservations du client
     */
    public function bookings()
    {
        return view('client.bookings');
    }

    /**
     * Afficher les messages du client
     */
    public function messages()
    {
        return view('client.messages');
    }

    /**
     * Afficher le profil du client
     */
    public function profile()
    {
        return view('client.profile');
    }

    /**
     * Afficher les paramètres du client
     */
    public function settings()
    {
        return view('client.settings');
    }

    /**
     * Afficher la page de recherche avancée
     */
    public function rechercheAvancee()
    {
        return view('client.recherche-avancee');
    }

    /**
     * Afficher la page de recherche
     */
    public function search()
    {
        return view('client.search');
    }
}
