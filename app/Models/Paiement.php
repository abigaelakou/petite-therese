<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'numero_recu',
        'type', 'montant_attendu', 'montant_paye',
        'reste_a_payer', 'mode_paiement',
        'reference_mobile_money', 'date_paiement',
        'statut', 'enregistre_par', 'observations',
    ];

    protected $casts = [
        'montant_attendu'    => 'decimal:2',
        'montant_paye'       => 'decimal:2',
        'reste_a_payer'      => 'decimal:2',
        'date_paiement'      => 'date',
    ];

    const TYPES = [
        'inscription'  => 'Frais d\'inscription',
        'scolarite_t1' => 'Scolarité — 1er trimestre',
        'scolarite_t2' => 'Scolarité — 2ème trimestre',
        'scolarite_t3' => 'Scolarité — 3ème trimestre',
        'autre'        => 'Autre',
    ];

    const MODES = [
        'especes'       => 'Espèces',
        'mobile_money'  => 'Mobile Money',
        'cheque'        => 'Chèque',
        'virement'      => 'Virement',
    ];

    const STATUTS = [
        'partiel'   => 'Partiel',
        'complet'   => 'Complet',
        'en_retard' => 'En retard',
    ];

    // Générer automatiquement le numéro de reçu
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($paiement) {
            if (empty($paiement->numero_recu)) {
                $count = static::count() + 1;
                $paiement->numero_recu = 'REC-' . date('Y') . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
            // Calculer automatiquement le reste à payer
            $paiement->reste_a_payer = $paiement->montant_attendu - $paiement->montant_paye;
            $paiement->statut = $paiement->reste_a_payer <= 0 ? 'complet' : 'partiel';
        });
    }

    // Relations
    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function enregistrePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enregistre_par');
    }

    // Accesseurs
    public function getEstSoldeAttribute(): bool
    {
        return $this->reste_a_payer <= 0;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}
