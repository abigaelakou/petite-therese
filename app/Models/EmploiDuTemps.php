<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploiDuTemps extends Model
{
    protected $table = 'emplois_du_temps';

    protected $fillable = [
        'classe_id', 'annee_scolaire_id',
        'jour', 'heure_debut', 'heure_fin',
        'matiere', 'enseignant_id', 'salle',
    ];

    const JOURS = [
        'lundi'    => 'Lundi',
        'mardi'    => 'Mardi',
        'mercredi' => 'Mercredi',
        'jeudi'    => 'Jeudi',
        'vendredi' => 'Vendredi',
        'samedi'   => 'Samedi',
    ];

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }
}
