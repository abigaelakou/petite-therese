<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnneeScolaire extends Model
{
    protected $table = 'annees_scolaires';

    protected $fillable = [
        'libelle', 'date_debut', 'date_fin',
        'est_active', 'est_archivee',
        'archivee_le', 'archive_par',
    ];

    protected $casts = [
        'date_debut'   => 'date',
        'date_fin'     => 'date',
        'est_active'   => 'boolean',
        'est_archivee' => 'boolean',
        'archivee_le'  => 'datetime',
    ];

    // Scope : année active
    public function scopeActive($query)
    {
        return $query->where('est_active', true);
    }

    // Relations
    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function bulletins(): HasMany
    {
        return $this->hasMany(Bulletin::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }

    public function archivePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archive_par');
    }

    // Accesseur : libellé formaté
    public function getLibelleCompletAttribute(): string
    {
        return "Année scolaire {$this->libelle}";
    }
}
