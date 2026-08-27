<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Circulaire extends Model
{
    protected $fillable = [
        'titre', 'type', 'destinataires', 'contenu',
        'fichier_joint', 'statut', 'date_publication', 'cree_par',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
    ];

    const TYPES = [
        'information' => '📢 Information',
        'convocation' => '📅 Convocation',
        'evenement'   => '🎉 Événement',
        'urgent'      => '🚨 Urgent',
        'autre'       => 'Autre',
    ];

    const DESTINATAIRES = [
        'tous'        => 'Tous',
        'enseignants' => 'Enseignants',
        'parents'     => 'Parents',
        'personnel'   => 'Personnel',
    ];

    const STATUTS = [
        'brouillon' => 'Brouillon',
        'publiee'   => 'Publiée',
        'archivee'  => 'Archivée',
    ];

    public function creePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    
}