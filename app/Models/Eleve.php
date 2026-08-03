<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eleve extends Model
{
    protected $fillable = [
        'matricule', 'nom', 'prenoms',
        'date_naissance', 'lieu_naissance', 'sexe',
        'photo',
        'nom_parent', 'telephone_parent',
        'telephone_parent_2', 'email_parent',
        'profession_parent', 'adresse_parent',
        'numero_extrait_naissance',
        'est_actif', 'est_archive',
        'archive_le', 'archive_par', 'user_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'est_actif'      => 'boolean',
        'est_archive'    => 'boolean',
        'archive_le'     => 'datetime',
    ];

    // Générer automatiquement le matricule
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($eleve) {
            if (empty($eleve->matricule)) {
                $annee = date('Y');
                $count = static::whereYear('created_at', $annee)->count() + 1;
                $eleve->matricule = 'PT-' . $annee . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('est_actif', true)->where('est_archive', false);
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function archivePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archive_par');
    }

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function bulletins(): HasMany
    {
        return $this->hasMany(Bulletin::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    // Inscription en cours
    public function inscriptionEnCours()
    {
        return $this->inscriptions()
            ->where('statut', 'validee')
            ->whereHas('anneeScolaire', fn($q) => $q->where('est_active', true))
            ->with(['classe', 'anneeScolaire'])
            ->first();
    }

    // Classe actuelle
    public function classeActuelle()
    {
        return $this->inscriptionEnCours()?->classe;
    }

    // Accesseurs
    public function getNomCompletAttribute(): string
    {
        return "{$this->nom} {$this->prenoms}";
    }

    public function getAgeAttribute(): int
    {
        return $this->date_naissance->age;
    }

    public function getSexeLabelAttribute(): string
    {
        return $this->sexe === 'M' ? 'Masculin' : 'Féminin';
    }
}
