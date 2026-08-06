<?php

namespace App\Exports;

use App\Models\Eleve;
use App\Models\AnneeScolaire;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ElevesExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    public function __construct(
        private ?int $anneeId = null,
        private ?int $classeId = null,
    ) {}

    public function query()
    {
        return Eleve::with(['inscriptions.classe', 'inscriptions.anneeScolaire'])
            ->where('est_actif', true)
            ->where('est_archive', false)
            ->when($this->anneeId, function($q) {
                $q->whereHas('inscriptions', fn($i) =>
                    $i->where('annee_scolaire_id', $this->anneeId)->where('statut', 'validee')
                );
            })
            ->when($this->classeId, function($q) {
                $q->whereHas('inscriptions', fn($i) =>
                    $i->where('classe_id', $this->classeId)->where('statut', 'validee')
                );
            })
            ->orderBy('nom');
    }

    public function headings(): array
    {
        return [
            'Matricule', 'Nom', 'Prénoms', 'Sexe',
            'Date naissance', 'Lieu naissance',
            'Classe', 'Année scolaire',
            'Nom parent', 'Téléphone parent',
            'Email parent', 'Adresse',
        ];
    }

    public function map($e): array
    {
        $inscription = $e->inscriptions
            ->where('statut', 'validee')
            ->when($this->anneeId, fn($c) => $c->where('annee_scolaire_id', $this->anneeId))
            ->first();

        return [
            $e->matricule,
            $e->nom,
            $e->prenoms,
            $e->sexe === 'M' ? 'Masculin' : 'Féminin',
            $e->date_naissance?->format('d/m/Y'),
            $e->lieu_naissance,
            $inscription?->classe?->nom ?? '—',
            $inscription?->anneeScolaire?->libelle ?? '—',
            $e->nom_parent,
            $e->telephone_parent,
            $e->email_parent ?? '—',
            $e->adresse_parent ?? '—',
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

    public function title(): string { return 'Élèves'; }
}