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

class ImpayesExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    public function __construct(private ?int $anneeId = null) {}

    public function query()
    {
        return Paiement::with(['eleve', 'anneeScolaire'])
            ->where('reste_a_payer', '>', 0)
            ->where('categorie', 'scolarite')
            ->when($this->anneeId, fn($q) => $q->where('annee_scolaire_id', $this->anneeId))
            ->orderBy('reste_a_payer', 'desc');
    }

    public function headings(): array
    {
        return [
            'Matricule', 'Nom', 'Prénoms',
            'Téléphone parent', 'Type', 'Montant attendu',
            'Montant payé', 'Reste dû', 'Dernier paiement',
            'Relancé', 'Année scolaire',
        ];
    }

    public function map($p): array
    {
        $flat = array_merge(Paiement::TYPES_SCOLARITE, Paiement::TYPES_DIVERS);
        return [
            $p->eleve?->matricule,
            $p->eleve?->nom,
            $p->eleve?->prenoms,
            $p->eleve?->telephone_parent,
            $flat[$p->type] ?? $p->type,
            $p->montant_attendu,
            $p->montant_paye,
            $p->reste_a_payer,
            $p->date_paiement?->format('d/m/Y'),
            $p->relance_envoyee ? 'Oui' : 'Non',
            $p->anneeScolaire?->libelle,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFDC2626']],
            ],
        ];
    }

    public function title(): string { return 'Impayés'; }
}