<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Circulaire extends Model
{
    protected $fillable = [
        'titre', 'contenu', 'destinataires',
        'statut', 'publiee_le', 'creee_par',
    ];

    protected $casts = [
        'publiee_le' => 'datetime',
    ];

    const DESTINATAIRES = [
        'tous'        => 'Tous',
        'parents'     => 'Parents',
        'enseignants' => 'Enseignants',
        'eleves'      => 'Élèves',
    ];

    public function creePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creee_par');
    }
}
