<?php

namespace App\Filament\Resources\Certificats\Tables;

use App\Models\Certificat;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CertificatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero_certificat')
                    ->label('N° Certificat')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary')
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
                    ->color('gray'),

                TextColumn::make('classe.nom')
                    ->label('Classe')
                    ->badge()
                    ->color('info')
                    ->default('—'),

                TextColumn::make('anneeScolaire.libelle')
                    ->label('Année')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('motif')
                    ->label('Motif')
                    ->limit(30)
                    ->toggleable(),

                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'success' => 'valide',
                        'danger'  => 'annule',
                    ])
                    ->formatStateUsing(fn($state) => Certificat::STATUTS[$state] ?? $state),

                TextColumn::make('delivrePar.name')
                    ->label('Délivré par')
                    ->toggleable(),

                TextColumn::make('delivre_le')
                    ->label('Délivré le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Certificat::STATUTS),
                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle'),
            ])
            ->recordActions([
                Action::make('imprimer')
                    ->label('Imprimer')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->visible(fn($record) => $record->statut === 'valide')
                    ->url(fn($record) => route('certificats.pdf', $record))
                    ->openUrlInNewTab(),

                Action::make('annuler')
                    ->label('Annuler')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->statut === 'valide'
                        && auth()->user()->hasAnyRole(['super_admin', 'directeur']))
                    ->requiresConfirmation()
                    ->modalHeading('Annuler ce certificat ?')
                    ->action(fn($record) => $record->update(['statut' => 'annule'])),

                EditAction::make()->label('Modifier')
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'directeur'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('delivre_le', 'desc');
    }
}