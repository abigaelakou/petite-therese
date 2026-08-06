<?php

namespace App\Filament\Pages;

use App\Exports\ElevesExport;
use App\Exports\ImpayesExport;
use App\Exports\PaiementsExport;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Maatwebsite\Excel\Facades\Excel;

class Rapports extends Page
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedDocumentChartBar;
    protected string $view = 'filament.pages.rapports';
    protected static ?string $navigationLabel = 'Rapports & Exports';
    protected static ?string $title = 'Rapports & Exports';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'Reporting';
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'comptable']) ?? false;
    }

    // Filtres
    public ?int $annee_id = null;
    public ?int $classe_id = null;
    public ?string $mois = null;
    public ?string $categorie = null;

    public function mount(): void
    {
        $annee = AnneeScolaire::where('est_active', true)->first();
        $this->annee_id = $annee?->id;
    }

    // ── EXPORTS EXCEL ────────────────────────────────────────

    public function exportPaiementsExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filename = 'paiements-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(
            new PaiementsExport($this->annee_id, $this->mois, $this->categorie),
            $filename
        );
    }

    public function exportImpayesExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filename = 'impayes-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new ImpayesExport($this->annee_id), $filename);
    }

    public function exportElevesExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filename = 'eleves-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new ElevesExport($this->annee_id, $this->classe_id), $filename);
    }

    // ── EXPORTS PDF ──────────────────────────────────────────

    public function exportPaiementsPdf(): mixed
    {
        return redirect()->route('rapports.paiements.pdf', [
            'annee_id'  => $this->annee_id,
            'mois'      => $this->mois,
            'categorie' => $this->categorie,
        ]);
    }

    public function exportImpayes_Pdf(): mixed
    {
        return redirect()->route('rapports.impayes.pdf', [
            'annee_id' => $this->annee_id,
        ]);
    }

    public function exportElevesPdf(): mixed
    {
        return redirect()->route('rapports.eleves.pdf', [
            'annee_id'  => $this->annee_id,
            'classe_id' => $this->classe_id,
        ]);
    }

    // Données pour la vue
    public function getAnnees(): array
    {
        return AnneeScolaire::orderBy('libelle', 'desc')->pluck('libelle', 'id')->toArray();
    }

    public function getClasses(): array
    {
        return Classe::when($this->annee_id, fn($q) => $q->where('annee_scolaire_id', $this->annee_id))
            ->orderBy('nom')->pluck('nom', 'id')->toArray();
    }

    public function getMois(): array
    {
        return [
            '01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
            '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
            '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
            '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre',
        ];
    }
}