<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'nom', 'email', 'telephone',
        'sujet', 'message', 'statut',
        'traite_par', 'traite_le', 'reponse',
    ];

    protected $casts = [
        'traite_le' => 'datetime',
    ];

    const STATUTS = [
        'non_lu' => 'Non lu',
        'lu'     => 'Lu',
        'traite' => 'Traité',
    ];

    public function traitePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'traite_par');
    }
}
