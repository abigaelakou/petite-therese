<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    protected $fillable = [
        'annee_scolaire_id', 'type', 'description',
        'chemin_fichier', 'archive_par', 'archivee_le',
    ];

    protected $casts = [
        'archivee_le' => 'datetime',
    ];

    const TYPES = [
        'annee_scolaire' => 'Année scolaire',
        'eleve'          => 'Dossier élève',
        'classe'         => 'Classe',
        'paiements'      => 'Paiements',
        'bulletins'      => 'Bulletins',
    ];

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function archivePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archive_par');
    }
}
