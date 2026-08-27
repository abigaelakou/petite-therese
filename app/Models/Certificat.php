<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificat extends Model
{
    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'classe_id',
        'numero_certificat', 'delivre_par', 'delivre_le',
        'motif', 'statut',
    ];

    protected $casts = [
        'delivre_le' => 'datetime',
    ];

    const STATUTS = [
        'valide'  => 'Valide',
        'annule'  => 'Annulé',
    ];

    // Génération automatique du numéro
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($certificat) {
            if (empty($certificat->numero_certificat)) {
                $count = static::whereYear('created_at', now()->year)->count() + 1;
                $certificat->numero_certificat = 'CERT-' . now()->year . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
            if (empty($certificat->delivre_par) && auth()->check()) {
                $certificat->delivre_par = auth()->id();
            }
        });
    }

    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function delivrePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivre_par');
    }
}