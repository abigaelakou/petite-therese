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

    const NIVEAUX = [
        'ms'  => 'Moyenne Section (MS)',
        'gs'  => 'Grande Section (GS)',
        'cp1' => 'CP1',
        'cp2' => 'CP2',
        'ce1' => 'CE1',
        'ce2' => 'CE2',
        'cm1' => 'CM1',
        'cm2' => 'CM2',
    ];

    const NIVEAUX_MATERNELLE = [
        'ms' => 'Moyenne Section (MS)',
        'gs' => 'Grande Section (GS)',
    ];

    const NIVEAUX_PRIMAIRE = [
        'cp1' => 'CP1',
        'cp2' => 'CP2',
        'ce1' => 'CE1',
        'ce2' => 'CE2',
        'cm1' => 'CM1',
        'cm2' => 'CM2',
    ];

    const CYCLES = [
        'maternelle' => 'Maternelle',
        'primaire'   => 'Primaire',
    ];

    const CLASSES_PAR_NIVEAU = [
        'ms'  => ['MS A',  'MS B'],
        'gs'  => ['GS A',  'GS B'],
        'cp1' => ['CP1 A', 'CP1 B'],
        'cp2' => ['CP2 A', 'CP2 B'],
        'ce1' => ['CE1 A', 'CE1 B'],
        'ce2' => ['CE2 A', 'CE2 B'],
        'cm1' => ['CM1 A', 'CM1 B'],
        'cm2' => ['CM2 A', 'CM2 B'],
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($classe) {
            $classe->cycle = in_array($classe->niveau, ['ms', 'gs'])
                ? 'maternelle'
                : 'primaire';
        });
    }

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

    public function getNombreElevesAttribute(): int
    {
        return $this->inscriptions()->where('statut', 'validee')->count();
    }

    public function getPlacesDisponiblesAttribute(): int
    {
        return $this->capacite - $this->nombre_eleves;
    }
}