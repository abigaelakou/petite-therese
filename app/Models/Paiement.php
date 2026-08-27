<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'numero_recu',
        'type', 'categorie',
        'montant_attendu', 'montant_paye',
        'reste_a_payer', 'montant_reporte',
        'annee_precedente_id',
        'mode_paiement', 'reference_mobile_money',
        'date_paiement', 'statut',
        'relance_envoyee', 'relance_le', 'relance_par',
        'enregistre_par', 'observations',
    ];

    protected $casts = [
        'montant_attendu'  => 'decimal:2',
        'montant_paye'     => 'decimal:2',
        'reste_a_payer'    => 'decimal:2',
        'montant_reporte'  => 'decimal:2',
        'date_paiement'    => 'date',
        'relance_le'       => 'datetime',
        'relance_envoyee'  => 'boolean',
    ];

    // Types scolarité
    const TYPES_SCOLARITE = [
        'inscription' => 'Frais d\'inscription',
        'versement_1' => '1er versement',
        'versement_2' => '2ème versement',
        'versement_3' => '3ème versement',
        'versement_4' => '4ème versement',
    ];

    // Types divers
    const TYPES_DIVERS = [
        'cantine'             => 'Cantine',
        'sortie_pedagogique'  => 'Sortie pédagogique',
        'fete_scolaire'       => 'Fête scolaire',
        'uniforme'            => 'Uniforme',
        'fournitures'         => 'Fournitures',
        'autre'               => 'Autre',
    ];

    // Tous les types
    const TYPES = [
        'Scolarité' => [
            'inscription' => 'Frais d\'inscription',
            'versement_1' => '1er versement',
            'versement_2' => '2ème versement',
            'versement_3' => '3ème versement',
            'versement_4' => '4ème versement',
        ],
        'Divers' => [
            'cantine'            => 'Cantine',
            'sortie_pedagogique' => 'Sortie pédagogique',
            'fete_scolaire'      => 'Fête scolaire',
            'uniforme'           => 'Uniforme',
            'fournitures'        => 'Fournitures',
            'autre'              => 'Autre',
        ],
    ];

    const CATEGORIES = [
        'scolarite' => 'Scolarité',
        'divers'    => 'Divers',
    ];

    const MODES = [
        'especes'      => 'Espèces',
        'mobile_money' => 'Mobile Money (MTN/Moov)',
        'wave'         => 'Wave',
        'cheque'       => 'Chèque',
        'virement'     => 'Virement',
    ];

    const STATUTS = [
        'partiel'   => 'Partiel',
        'complet'   => 'Complet',
        'en_retard' => 'En retard',
        'reporte'   => 'Reporté',
    ];

    // Génération automatique numéro reçu + calcul solde
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($paiement) {
            if (empty($paiement->numero_recu)) {
                $count = static::count() + 1;
                $paiement->numero_recu = 'REC-' . date('Y') . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
            // Calcul automatique reste à payer
            $paiement->reste_a_payer = max(0, $paiement->montant_attendu - $paiement->montant_paye);
            // Statut automatique
            $paiement->statut = $paiement->reste_a_payer <= 0 ? 'complet' : 'partiel';
            // Catégorie automatique selon type
            $paiement->categorie = array_key_exists($paiement->type, self::TYPES_SCOLARITE)
                ? 'scolarite' : 'divers';
            // Enregistré par
            if (empty($paiement->enregistre_par) && auth()->check()) {
                $paiement->enregistre_par = auth()->id();
            }
        });

        static::updating(function ($paiement) {
            $paiement->reste_a_payer = max(0, $paiement->montant_attendu - $paiement->montant_paye);
            $paiement->statut = $paiement->reste_a_payer <= 0 ? 'complet' : 'partiel';
            $paiement->categorie = array_key_exists($paiement->type, self::TYPES_SCOLARITE)
                ? 'scolarite' : 'divers';
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

    public function anneePrecedente(): BelongsTo
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_precedente_id');
    }

    public function enregistrePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enregistre_par');
    }

    public function relancePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'relance_par');
    }

    // Accesseurs
    public function getEstSoldeAttribute(): bool
    {
        return $this->reste_a_payer <= 0;
    }

    public function getTypeLabelAttribute(): string
    {
        $flat = array_merge(self::TYPES_SCOLARITE, self::TYPES_DIVERS);
        return $flat[$this->type] ?? $this->type;
    }

    // Scope : impayés
    public function scopeImpayes($query)
    {
        return $query->where('reste_a_payer', '>', 0);
    }

    // Scope : scolarité seulement
    public function scopeScolarite($query)
    {
        return $query->where('categorie', 'scolarite');
    }

    // Calculer le solde total dû d'un élève sur une année
    public static function soldeEleve(int $eleveId, int $anneeId): float
    {
        return (float) static::where('eleve_id', $eleveId)
            ->where('annee_scolaire_id', $anneeId)
            ->where('categorie', 'scolarite')
            ->sum('reste_a_payer');
    }

    // Vérifier si un élève a des impayés sur l'année précédente
    public static function soldeAnneePrecedente(int $eleveId): array
    {
        $anneePrecedente = AnneeScolaire::where('est_active', false)
            ->where('est_archivee', false)
            ->orderBy('date_fin', 'desc')
            ->first();

        if (!$anneePrecedente) return ['solde' => 0, 'annee' => null];

        $solde = static::soldeEleve($eleveId, $anneePrecedente->id);
        return ['solde' => $solde, 'annee' => $anneePrecedente];
    }
}