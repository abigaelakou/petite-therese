<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'type',
        'nom_fichier', 'chemin_fichier', 'ajoute_par',
    ];

    const TYPES = [
        'extrait_naissance'   => 'Extrait de naissance',
        'carnet_sante'        => 'Carnet de santé',
        'certificat_scolarite' => 'Certificat de scolarité',
        'attestation'         => 'Attestation',
        'autre'               => 'Autre',
    ];

    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function ajoutePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ajoute_par');
    }
}
