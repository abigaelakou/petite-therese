<?php

namespace App\Filament\Resources\Classes\Tables;

use App\Models\Classe;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClassesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->label('Classe')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                BadgeColumn::make('niveau')
                    ->label('Niveau')
                    ->formatStateUsing(fn($state) => Classe::NIVEAUX[$state] ?? $state)
                    ->colors([
                        'warning' => fn($state) => in_array($state, ['ms', 'gs']),
                        'primary' => fn($state) => in_array($state, ['cp1', 'cp2', 'ce1', 'ce2']),
                        'success' => fn($state) => in_array($state, ['cm1', 'cm2']),
                    ]),
                BadgeColumn::make('cycle')
                    ->label('Cycle')
                    ->colors([
                        'warning' => 'maternelle',
                        'primary' => 'primaire',
                    ])
                    ->formatStateUsing(fn($state) => Classe::CYCLES[$state] ?? $state),
                TextColumn::make('anneeScolaire.libelle')
                    ->label('Année scolaire')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('enseignant.name')
                    ->label('Enseignant')
                    ->default('—'),
                TextColumn::make('inscriptions_count')
                    ->label('Élèves')
                    ->counts('inscriptions')
                    ->badge()
                    ->color('success'),
                TextColumn::make('capacite')
                    ->label('Capacité')
                    ->suffix(' élèves'),
            ])
            ->filters([
                SelectFilter::make('niveau')
                    ->label('Niveau')
                    ->options(Classe::NIVEAUX),
                SelectFilter::make('cycle')
                    ->label('Cycle')
                    ->options(Classe::CYCLES),
                SelectFilter::make('annee_scolaire_id')
                    ->label('Année scolaire')
                    ->relationship('anneeScolaire', 'libelle'),
            ])
            ->recordActions([
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->defaultSort('nom');
    }
}