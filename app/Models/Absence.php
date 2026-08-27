<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    protected $fillable = [
        'eleve_id', 'classe_id', 'annee_scolaire_id',
        'date', 'periode', 'justifiee',
        'motif', 'enregistree_par',
    ];

    protected $casts = [
        'date'      => 'date',
        'justifiee' => 'boolean',
    ];

    const PERIODES = [
        'matin'           => 'Matin',
        'apres_midi'      => 'Après-midi',
        'journee_entiere' => 'Journée entière',
    ];

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

    public function enregistreePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enregistree_par');
    }
}
