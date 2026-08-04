<?php

namespace App\Filament\Widgets;

use App\Models\AnneeScolaire;
use App\Models\Paiement;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Impayes extends BaseWidget
{
    protected static ?string $heading = '⚠️ Impayés — Scolarité en cours';
    protected static ?int $sort = 6;
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'comptable']) ?? false;
    }

    public function table(Table $table): Table
    {
        $annee = AnneeScolaire::where('est_active', true)->first();

        return $table
            ->query(
                Paiement::with(['eleve', 'anneeScolaire'])
                    ->where('reste_a_payer', '>', 0)
                    ->where('categorie', 'scolarite')
                    ->when($annee, fn($q) => $q->where('annee_scolaire_id', $annee->id))
                    ->latest('date_paiement')
            )
            ->columns([
                TextColumn::make('eleve.nom')->label('Élève')
                    ->formatStateUsing(fn($record) => $record->eleve?->nom . ' ' . $record->eleve?->prenoms)
                    ->weight('bold')->searchable(),
                TextColumn::make('eleve.matricule')->label('Matricule')->badge()->color('gray'),
                TextColumn::make('type')->label('Type')
                    ->formatStateUsing(function ($state) {
                        $flat = array_merge(Paiement::TYPES_SCOLARITE, Paiement::TYPES_DIVERS);
                        return $flat[$state] ?? $state;
                    })->badge()->color('warning'),
                TextColumn::make('montant_attendu')->label('Attendu')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' F'),
                TextColumn::make('montant_paye')->label('Payé')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' F')->color('success'),
                TextColumn::make('reste_a_payer')->label('Reste dû')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->color('danger')->weight('bold'),
                TextColumn::make('eleve.telephone_parent')->label('Tél. parent')
                    ->copyable()->copyMessage('Numéro copié !'),
                TextColumn::make('date_paiement')->label('Dernier paiement')->date('d/m/Y'),
            ])
            ->actions([])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5);
    }
}