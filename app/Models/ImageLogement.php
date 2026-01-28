<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLogement extends Model
{
    protected $fillable = ['chemin', 'logement_id'];

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }
}