<?php

namespace App\Exports;

use App\Models\Paiement;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class PaiementsExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    public function __construct(
        private ?int $anneeId = null,
        private ?string $mois = null,
        private ?string $categorie = null,
    ) {}

    public function query()
    {
        return Paiement::with(['eleve', 'anneeScolaire', 'enregistrePar'])
            ->when($this->anneeId, fn($q) => $q->where('annee_scolaire_id', $this->anneeId))
            ->when($this->mois, fn($q) => $q->whereMonth('date_paiement', $this->mois)->whereYear('date_paiement', now()->year))
            ->when($this->categorie, fn($q) => $q->where('categorie', $this->categorie))
            ->orderBy('date_paiement', 'desc');
    }

    public function headings(): array
    {
        return [
            'N° Reçu', 'Matricule', 'Nom Élève', 'Prénoms',
            'Type', 'Catégorie', 'Mode paiement',
            'Montant attendu', 'Montant payé', 'Reste à payer',
            'Statut', 'Date paiement', 'Enregistré par', 'Année scolaire',
        ];
    }

    public function map($paiement): array
    {
        $flat = array_merge(Paiement::TYPES_SCOLARITE, Paiement::TYPES_DIVERS);
        return [
            $paiement->numero_recu,
            $paiement->eleve?->matricule,
            $paiement->eleve?->nom,
            $paiement->eleve?->prenoms,
            $flat[$paiement->type] ?? $paiement->type,
            Paiement::CATEGORIES[$paiement->categorie] ?? $paiement->categorie,
            Paiement::MODES[$paiement->mode_paiement] ?? $paiement->mode_paiement,
            $paiement->montant_attendu,
            $paiement->montant_paye,
            $paiement->reste_a_payer,
            Paiement::STATUTS[$paiement->statut] ?? $paiement->statut,
            $paiement->date_paiement?->format('d/m/Y'),
            $paiement->enregistrePar?->name,
            $paiement->anneeScolaire?->libelle,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1B2B6B']],
            ],
        ];
    }

    public function title(): string
    {
        return 'Paiements';
    }
}