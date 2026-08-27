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
        // Données scolaires
        'Données scolaires' => [
            'annee_scolaire' => 'Année scolaire complète',
            'eleve'          => 'Dossier élève',
            'classe'         => 'Registre de classe',
            'paiements'      => 'Registre des paiements',
            'bulletins'      => 'Bulletins scolaires',
        ],
        // Documents administratifs
        'Documents administratifs' => [
            'registre_commerce'      => 'Registre de commerce',
            'dossier_administratif'  => 'Dossier administratif',
            'contrat'                => 'Contrat',
            'autorisation'           => 'Autorisation / Agrément',
            'correspondance'         => 'Correspondance officielle',
            'rapport_inspection'     => 'Rapport d\'inspection',
            'autre'                  => 'Autre document',
        ],
    ];

    // Version plate pour les badges
    const TYPES_FLAT = [
        'annee_scolaire'        => 'Année scolaire',
        'eleve'                 => 'Dossier élève',
        'classe'                => 'Registre classe',
        'paiements'             => 'Paiements',
        'bulletins'             => 'Bulletins',
        'registre_commerce'     => 'Registre commerce',
        'dossier_administratif' => 'Dossier admin.',
        'contrat'               => 'Contrat',
        'autorisation'          => 'Autorisation',
        'correspondance'        => 'Correspondance',
        'rapport_inspection'    => 'Rapport inspection',
        'autre'                 => 'Autre',
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