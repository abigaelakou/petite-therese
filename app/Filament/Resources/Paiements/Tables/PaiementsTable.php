<?php

namespace App\Filament\Resources\Paiements\Tables;

use App\Models\AnneeScolaire;
use App\Models\Paiement;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PaiementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero_recu')
                    ->label('N° Reçu')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Numéro copié !'),

                TextColumn::make('eleve.nom')
                    ->label('Élève')
                    ->formatStateUsing(fn($record) => $record->eleve?->nom . ' ' . $record->eleve?->prenoms)
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('eleve.matricule')
                    ->label('Matricule')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                BadgeColumn::make('categorie')
                    ->label('Catégorie')
                    ->colors([
                        'primary' => 'scolarite',
                        'warning' => 'divers',
                    ])
                    ->formatStateUsing(fn($state) => Paiement::CATEGORIES[$state] ?? $state),

                TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(function ($state) {
                        $flat = array_merge(
                            Paiement::TYPES_SCOLARITE,
                            Paiement::TYPES_DIVERS
                        );
                        return $flat[$state] ?? $state;
                    })
                    ->badge()
                    ->color('info'),

                TextColumn::make('montant_attendu')
                    ->label('Attendu')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->sortable(),

                TextColumn::make('montant_paye')
                    ->label('Payé')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->color('success')
                    ->sortable(),

                TextColumn::make('reste_a_payer')
                    ->label('Reste dû')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->color(fn($state) => $state > 0 ? 'danger' : 'success')
                    ->weight(fn($state) => $state > 0 ? 'bold' : 'normal')
                    ->sortable(),

                BadgeColumn::make('mode_paiement')
                    ->label('Mode')
                    ->colors([
                        'gray'    => 'especes',
                        'success' => 'mobile_money',
                        'info'    => 'wave',
                        'warning' => 'cheque',
                        'primary' => 'virement',
                    ])
                    ->formatStateUsing(fn($state) => Paiement::MODES[$state] ?? $state),

                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'partiel',
                        'success' => 'complet',
                        'danger'  => 'en_retard',
                        'info'    => 'reporte',
                    ])
                    ->formatStateUsing(fn($state) => Paiement::STATUTS[$state] ?? $state),

                TextColumn::make('date_paiement')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                BadgeColumn::make('relance_envoyee')
                    ->label('Relancé')
                    ->colors([
                        'success' => true,
                        'gray'    => false,
                    ])
                    ->formatStateUsing(fn($state) => $state ? 'Oui' : 'Non')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('categorie')
                    ->label('Catégorie')
                    ->options(Paiement::CATEGORIES),

                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Paiement::STATUTS),

                SelectFilter::make('mode_paiement')
                    ->label('Mode')
                    ->options(Paiement::MODES),

                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle')
                    ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id),

                TernaryFilter::make('relance_envoyee')
                    ->label('Relancé'),

                TernaryFilter::make('reste_a_payer')
                    ->label('Impayés uniquement')
                    ->queries(
                        true: fn($query) => $query->where('reste_a_payer', '>', 0),
                        false: fn($query) => $query->where('reste_a_payer', '=', 0),
                    ),
            ])
            ->recordActions([
                Action::make('imprimer_recu')
                    ->label('Reçu PDF')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->url(fn($record) => route('paiements.recu', $record))
                    ->openUrlInNewTab(),

                Action::make('relancer')
                    ->label('Marquer relancé')
                    ->icon('heroicon-o-bell')
                    ->color('warning')
                    ->visible(fn($record) => $record->reste_a_payer > 0 && !$record->relance_envoyee)
                    ->requiresConfirmation()
                    ->modalHeading('Marquer ce paiement comme relancé ?')
                    ->action(function ($record) {
                        $record->update([
                            'relance_envoyee' => true,
                            'relance_le'      => now(),
                            'relance_par'     => auth()->id(),
                        ]);
                        Notification::make()
                            ->title('Relance enregistrée')
                            ->success()
                            ->send();
                    }),

                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('date_paiement', 'desc');
    }
}