<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipe extends Model
{
    protected $table = 'equipe';

    protected $fillable = [
        'nom', 'prenoms', 'poste', 'categorie',
        'photo', 'facebook', 'whatsapp', 'linkedin',
        'email', 'bio', 'ordre', 'est_visible', 'est_actif',
    ];

    protected $casts = [
        'est_visible' => 'boolean',
        'est_actif'   => 'boolean',
    ];

    const CATEGORIES = [
        'direction'  => 'Direction',
        'enseignant' => 'Enseignant',
        'staff'      => 'Staff',
    ];

    // Scopes
    public function scopeVisibles($query)
    {
        return $query->where('est_visible', true)->where('est_actif', true)->orderBy('ordre');
    }

    public function scopeDirection($query)
    {
        return $query->where('categorie', 'direction')->visibles();
    }

    public function scopeEnseignants($query)
    {
        return $query->where('categorie', 'enseignant')->visibles();
    }

    // Accesseurs
    public function getNomCompletAttribute(): string
    {
        return trim("{$this->nom} {$this->prenoms}");
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('assets/img/team/default.jpg');
    }
}