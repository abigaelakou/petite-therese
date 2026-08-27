<?php

namespace App\Filament\Widgets;

use App\Models\Paiement;
use Filament\Widgets\ChartWidget;

class PaiementsChart extends ChartWidget
{
    protected ?string $heading = 'Paiements mensuels (scolarité)';
    protected static ?int $sort = 3;
    protected ?string $maxHeight = '280px';

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'comptable']) ?? false;
    }

    protected function getData(): array
    {
        $mois = [];
        $scolarite = [];
        $divers = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $mois[] = $date->translatedFormat('M');
            $scolarite[] = (float) Paiement::whereMonth('date_paiement', $date->month)
                ->whereYear('date_paiement', $date->year)
                ->where('categorie', 'scolarite')->sum('montant_paye');
            $divers[] = (float) Paiement::whereMonth('date_paiement', $date->month)
                ->whereYear('date_paiement', $date->year)
                ->where('categorie', 'divers')->sum('montant_paye');
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Scolarité',
                    'data'            => $scolarite,
                    'backgroundColor' => 'rgba(27,43,107,0.8)',
                    'borderColor'     => '#1B2B6B',
                    'borderWidth'     => 2,
                    'borderRadius'    => 4,
                ],
                [
                    'label'           => 'Divers',
                    'data'            => $divers,
                    'backgroundColor' => 'rgba(201,168,76,0.7)',
                    'borderColor'     => '#C9A84C',
                    'borderWidth'     => 2,
                    'borderRadius'    => 4,
                ],
            ],
            'labels' => $mois,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}