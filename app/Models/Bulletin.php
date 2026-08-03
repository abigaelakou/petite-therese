<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulletin extends Model
{
    protected $fillable = [
        'eleve_id', 'classe_id', 'annee_scolaire_id',
        'periode', 'moyenne_generale', 'rang',
        'effectif_classe', 'mention',
        'appreciation_directeur', 'appreciation_enseignant',
        'est_publie', 'publie_le', 'genere_par',
    ];

    protected $casts = [
        'moyenne_generale' => 'decimal:2',
        'est_publie'       => 'boolean',
        'publie_le'        => 'datetime',
    ];

    const MENTIONS = [
        'TB' => 'Très Bien',
        'B'  => 'Bien',
        'AB' => 'Assez Bien',
        'P'  => 'Passable',
        'I'  => 'Insuffisant',
    ];

    // Calculer la mention selon la moyenne
    public static function calculerMention(float $moyenne): string
    {
        if ($moyenne >= 16) return 'TB';
        if ($moyenne >= 14) return 'B';
        if ($moyenne >= 12) return 'AB';
        if ($moyenne >= 10) return 'P';
        return 'I';
    }

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

    public function generePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'genere_par');
    }
}
