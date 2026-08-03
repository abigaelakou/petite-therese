<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $fillable = [
        'annee_scolaire_id', 'nom', 'niveau',
        'cycle', 'capacite', 'enseignant_id',
    ];

    // Labels lisibles pour les niveaux
    const NIVEAUX = [
        'ps'  => 'Petite Section (PS)',
        'ms'  => 'Moyenne Section (MS)',
        'gs'  => 'Grande Section (GS)',
        'cp'  => 'CP',
        'ce1' => 'CE1',
        'ce2' => 'CE2',
        'cm1' => 'CM1',
        'cm2' => 'CM2',
    ];

    const CYCLES = [
        'maternelle' => 'Maternelle',
        'primaire'   => 'Primaire',
    ];

    // Relations
    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
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

    public function emploisDuTemps(): HasMany
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    // Accesseurs
    public function getNomCompletAttribute(): string
    {
        $niveau = self::NIVEAUX[$this->niveau] ?? $this->niveau;
        return "{$this->nom} — {$niveau}";
    }

    public function getNombreElevesAttribute(): int
    {
        return $this->inscriptions()->where('statut', 'validee')->count();
    }

    public function getPlacesDisponiblesAttribute(): int
    {
        return $this->capacite - $this->nombre_eleves;
    }
}
