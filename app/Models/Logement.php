<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'prix',
        'adresse',
        'ville',
        'nb_chambres',
        'nb_salles_bain',
        'superficie',
        'wifi',
        'parking',
        'climatisation',
        'statut',
    ];

    protected $casts = [
        'wifi' => 'boolean',
        'parking' => 'boolean',
        'climatisation' => 'boolean',
        'prix' => 'decimal:2',
        'superficie' => 'decimal:2',
    ];

    // Relations
    public function bailleur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('ordre');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Méthodes utiles
    public function premierePhoto()
    {
        return $this->photos()->first();
    }

    public function estDisponible()
    {
        return $this->statut === 'disponible';
    }
}