<?php

namespace App\Filament\Resources\Inscriptions\Tables;

use App\Models\AnneeScolaire;
use App\Models\Inscription;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('eleve.nom')
                    ->label('Élève')
                    ->formatStateUsing(fn($record) => $record->eleve?->nom . ' ' . $record->eleve?->prenoms)
                    ->searchable(['nom', 'prenoms'])
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('eleve.matricule')
                    ->label('Matricule')
                    ->badge()
                    ->color('gray')
                    ->copyable(),

                TextColumn::make('classe.nom')
                    ->label('Classe')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('anneeScolaire.libelle')
                    ->label('Année scolaire')
                    ->badge()
                    ->color('gray'),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'success' => 'nouvelle',
                        'info'    => 'reinscription',
                    ])
                    ->formatStateUsing(fn($state) => Inscription::TYPES[$state] ?? $state),

                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'en_attente',
                        'success' => 'validee',
                        'danger'  => 'refusee',
                    ])
                    ->formatStateUsing(fn($state) => Inscription::STATUTS[$state] ?? $state),

                TextColumn::make('date_inscription')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Inscription::STATUTS),

                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle')
                    ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id),

                SelectFilter::make('classe_id')
                    ->label('Classe')
                    ->relationship('classe', 'nom'),
            ])
            ->recordActions([
                Action::make('valider')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->statut === 'en_attente')
                    ->requiresConfirmation()
                    ->modalHeading('Valider cette inscription ?')
                    ->modalDescription('L\'élève sera officiellement inscrit dans cette classe.')
                    ->action(function ($record) {
                        $record->update([
                            'statut'     => 'validee',
                            'validee_par' => auth()->id(),
                            'validee_le'  => now(),
                        ]);
                        Notification::make()
                            ->title('Inscription validée !')
                            ->body($record->eleve?->nom . ' ' . $record->eleve?->prenoms . ' inscrit en ' . $record->classe?->nom)
                            ->success()
                            ->send();
                    }),

                Action::make('refuser')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->statut === 'en_attente')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['statut' => 'refusee']);
                        Notification::make()->title('Inscription refusée')->warning()->send();
                    }),

                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('date_inscription', 'desc');
    }
}