<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    protected $fillable = [
        'eleve_id', 'classe_id', 'annee_scolaire_id',
        'matiere', 'coefficient', 'periode',
        'type_evaluation', 'note', 'note_sur',
        'saisie_par', 'appreciation',
    ];

    protected $casts = [
        'note'        => 'decimal:2',
        'note_sur'    => 'decimal:2',
        'coefficient' => 'integer',
    ];

    const PERIODES = [
        'trimestre_1' => '1er Trimestre',
        'trimestre_2' => '2ème Trimestre',
        'trimestre_3' => '3ème Trimestre',
        'semestre_1'  => '1er Semestre',
        'semestre_2'  => '2ème Semestre',
    ];

    const TYPES = [
        'composition'   => 'Composition',
        'devoir'        => 'Devoir',
        'interrogation' => 'Interrogation',
        'examen'        => 'Examen',
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

    public function saisiePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'saisie_par');
    }

    // Note sur 20
    public function getNoteRameneeSur20Attribute(): float
    {
        if ($this->note_sur == 0) return 0;
        return round(($this->note / $this->note_sur) * 20, 2);
    }
}
