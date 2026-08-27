<?php

namespace App\Filament\Resources\Documents\Tables;

use App\Models\Document;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'extrait_naissance',
                        'success' => 'carnet_sante',
                        'warning' => 'certificat_scolarite',
                        'info'    => 'attestation',
                        'gray'    => 'autre',
                    ])
                    ->formatStateUsing(fn($state) => Document::TYPES[$state] ?? $state),

                TextColumn::make('nom_fichier')
                    ->label('Fichier')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('anneeScolaire.libelle')
                    ->label('Année')
                    ->badge()
                    ->color('gray')
                    ->default('—'),

                TextColumn::make('ajoutePar.name')
                    ->label('Ajouté par')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options(Document::TYPES),
                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle'),
            ])
            ->recordActions([
                Action::make('telecharger')
                    ->label('Télécharger')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn($record) => asset('storage/' . $record->chemin_fichier))
                    ->openUrlInNewTab(),
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}