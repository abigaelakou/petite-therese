<?php

namespace App\Filament\Widgets;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use Filament\Widgets\ChartWidget;

class ElevesParClasse extends ChartWidget
{
    protected ?string $heading = 'Répartition des élèves par classe';
    protected static ?int $sort = 4;
    protected ?string $maxHeight = '280px';

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    protected function getData(): array
    {
        $annee = AnneeScolaire::where('est_active', true)->first();
        if (!$annee) return ['datasets' => [], 'labels' => []];

        $classes = Classe::where('annee_scolaire_id', $annee->id)
            ->withCount(['inscriptions' => fn($q) => $q->where('statut', 'validee')])
            ->orderBy('nom')->get();

        $colors = [
            '#1B2B6B','#C9A84C','#2E9EC5','#16a34a',
            '#dc2626','#7c3aed','#db2777','#ea580c',
            '#0891b2','#65a30d','#d97706','#6366f1',
            '#14b8a6','#f43f5e','#8b5cf6','#06b6d4',
        ];

        return [
            'datasets' => [[
                'data'            => $classes->pluck('inscriptions_count')->toArray(),
                'backgroundColor' => array_slice($colors, 0, $classes->count()),
                'borderWidth'     => 2,
                'borderColor'     => '#ffffff',
            ]],
            'labels' => $classes->pluck('nom')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}