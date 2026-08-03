<?php

namespace App\Filament\Resources\AnneeScolaires\Tables;

use App\Models\AnneeScolaire;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AnneeScolairesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('libelle')
                    ->label('Année scolaire')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('date_debut')
                    ->label('Début')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('date_fin')
                    ->label('Fin')
                    ->date('d/m/Y'),
                IconColumn::make('est_active')
                    ->label('En cours')
                    ->boolean(),
                IconColumn::make('est_archivee')
                    ->label('Archivée')
                    ->boolean(),
                TextColumn::make('classes_count')
                    ->label('Classes')
                    ->counts('classes')
                    ->badge()
                    ->color('primary'),
            ])
            ->filters([
                TernaryFilter::make('est_active')->label('Active'),
                TernaryFilter::make('est_archivee')->label('Archivée'),
            ])
            ->recordActions([
                Action::make('activer')
                    ->label('Définir comme active')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => !$record->est_active && !$record->est_archivee)
                    ->requiresConfirmation()
                    ->modalHeading('Activer cette année scolaire ?')
                    ->modalDescription('L\'année en cours sera désactivée.')
                    ->action(function ($record) {
                        AnneeScolaire::where('est_active', true)->update(['est_active' => false]);
                        $record->update(['est_active' => true]);
                        Notification::make()->title('Année scolaire activée !')->success()->send();
                    }),
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->defaultSort('libelle', 'desc');
    }
}