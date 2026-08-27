<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'titre', 'slug', 'extrait', 'contenu',
        'photo_couverture', 'categorie', 'statut',
        'publie_le', 'auteur_id', 'vues',
    ];

    protected $casts = [
        'publie_le' => 'datetime',
    ];

    const CATEGORIES = [
        'evenement'          => '🎉 Événement',
        'sortie_pedagogique' => '🚌 Sortie pédagogique',
        'remise_prix'        => '🏆 Remise de prix',
        'fete_scolaire'      => '🎊 Fête scolaire',
        'sport'              => '⚽ Sport',
        'annonce'            => '📢 Annonce',
        'autre'              => 'Autre',
    ];

    const STATUTS = [
        'brouillon' => 'Brouillon',
        'publie'    => 'Publié',
    ];

    // Générer le slug automatiquement
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->titre) . '-' . now()->format('YmdHis');
            }
            if (empty($article->auteur_id) && auth()->check()) {
                $article->auteur_id = auth()->id();
            }
        });
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    // Scope articles publiés
    public function scopePublie($query)
    {
        return $query->where('statut', 'publie')->orderBy('publie_le', 'desc');
    }
}