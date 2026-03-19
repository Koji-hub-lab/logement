<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'logement_id',
        'client_id',
        'statut',
        'message_client',
    ];

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Méthodes utiles
    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function estAcceptee()
    {
        return $this->statut === 'acceptée';
    }

    public function estRefusee()
    {
        return $this->statut === 'refusée';
    }
}