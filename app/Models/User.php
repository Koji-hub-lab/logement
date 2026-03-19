<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function logements()
    {
        return $this->hasMany(Logement::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    // Méthodes utiles
    public function estBailleur()
    {
        return $this->role === 'bailleur';
    }

    public function estClient()
    {
        return $this->role === 'client';
    }
}