<?php

namespace App\Filament\Resources\Archives\Tables;

use App\Models\Archive;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArchivesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => fn($s) => in_array($s, ['annee_scolaire','eleve','classe','paiements','bulletins']),
                        'warning' => fn($s) => in_array($s, ['registre_commerce','dossier_administratif','contrat','autorisation']),
                        'info'    => fn($s) => in_array($s, ['correspondance','rapport_inspection']),
                        'gray'    => 'autre',
                    ])
                    ->formatStateUsing(fn($state) => Archive::TYPES_FLAT[$state] ?? $state),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(60)
                    ->searchable()
                    ->wrap(),

                TextColumn::make('anneeScolaire.libelle')
                    ->label('Année')
                    ->badge()
                    ->color('gray')
                    ->default('—'),

                TextColumn::make('archivePar.name')
                    ->label('Archivé par')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('archivee_le')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('chemin_fichier')
                    ->label('Fichier')
                    ->formatStateUsing(fn($state) => $state ? '📎 Disponible' : '— Aucun')
                    ->color(fn($state) => $state ? 'success' : 'gray'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options(Archive::TYPES_FLAT),
                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle'),
            ])
            ->recordActions([
                Action::make('telecharger')
                    ->label('Télécharger')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn($record) => !empty($record->chemin_fichier))
                    ->url(fn($record) => route('archives.download', $record))
                    ->openUrlInNewTab(),
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('archivee_le', 'desc');
    }
}