<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscription extends Model
{
    protected $fillable = [
        'eleve_id', 'classe_id', 'annee_scolaire_id',
        'type', 'date_inscription', 'statut',
        'validee_par', 'validee_le',
        'inscription_precedente_id',
        'passage_automatique', 'observations',
    ];

    protected $casts = [
        'date_inscription'   => 'date',
        'validee_le'         => 'datetime',
        'passage_automatique' => 'boolean',
    ];

    const STATUTS = [
        'en_attente' => 'En attente',
        'validee'    => 'Validée',
        'refusee'    => 'Refusée',
    ];

    const TYPES = [
        'nouvelle'     => 'Nouvelle inscription',
        'reinscription' => 'Réinscription',
    ];

    // Relations
    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function valideePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validee_par');
    }

    public function inscriptionPrecedente(): BelongsTo
    {
        return $this->belongsTo(Inscription::class, 'inscription_precedente_id');
    }

    // Valider une inscription
    public function valider(User $par): void
    {
        $this->update([
            'statut'     => 'validee',
            'validee_par' => $par->id,
            'validee_le'  => now(),
        ]);
    }

    // Passage automatique en classe supérieure
    public static function passerEnClasseSuperieure(Eleve $eleve, Classe $nouvelleClasse, AnneeScolaire $annee): self
    {
        $precedente = $eleve->inscriptionEnCours();
        return static::create([
            'eleve_id'                => $eleve->id,
            'classe_id'               => $nouvelleClasse->id,
            'annee_scolaire_id'       => $annee->id,
            'type'                    => 'reinscription',
            'date_inscription'        => now(),
            'statut'                  => 'en_attente',
            'inscription_precedente_id' => $precedente?->id,
            'passage_automatique'      => true,
        ]);
    }
}
