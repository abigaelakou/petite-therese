<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriePhoto extends Model
{
    protected $table = 'galerie_photos';

    protected $fillable = [
        'titre', 'description', 'photo',
        'categorie', 'ordre', 'est_visible', 'ajoute_par',
    ];

    protected $casts = [
        'est_visible' => 'boolean',
    ];

    const CATEGORIES = [
        'vie_scolaire'       => 'Vie scolaire',
        'fete_scolaire'      => 'Fête scolaire',
        'sport'              => 'Sport',
        'remise_prix'        => 'Remise de prix',
        'sortie_pedagogique' => 'Sortie pédagogique',
        'autre'              => 'Autre',
    ];

    // Scopes
    public function scopeVisibles($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre')->orderBy('created_at', 'desc');
    }

    public function scopeParCategorie($query, string $categorie)
    {
        return $query->where('categorie', $categorie)->visibles();
    }

    // Accesseurs
    public function getPhotoUrlAttribute(): string
    {
        return asset('storage/' . $this->photo);
    }

    public function getCategorieLabelAttribute(): string
    {
        return self::CATEGORIES[$this->categorie] ?? $this->categorie;
    }

    public function ajoutePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ajoute_par');
    }
}