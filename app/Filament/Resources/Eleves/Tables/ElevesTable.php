<?php

namespace App\Filament\Resources\Eleves\Tables;

use App\Models\Eleve;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ElevesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('assets/img/team/default.jpg')),

                TextColumn::make('matricule')
                    ->label('Matricule')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Matricule copié !'),

                TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->formatStateUsing(fn($record) => $record->nom . ' ' . $record->prenoms),

                BadgeColumn::make('sexe')
                    ->label('Sexe')
                    ->colors([
                        'primary' => 'M',
                        'warning' => 'F',
                    ])
                    ->formatStateUsing(fn($state) => $state === 'M' ? 'Masculin' : 'Féminin'),

                TextColumn::make('date_naissance')
                    ->label('Date naiss.')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('nom_parent')
                    ->label('Parent')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('telephone_parent')
                    ->label('Téléphone')
                    ->copyable()
                    ->copyMessage('Numéro copié !')
                    ->toggleable(),

                BadgeColumn::make('est_actif')
                    ->label('Statut')
                    ->colors([
                        'success' => true,
                        'danger'  => false,
                    ])
                    ->formatStateUsing(fn($state) => $state ? 'Actif' : 'Inactif'),
            ])
            ->filters([
                SelectFilter::make('sexe')
                    ->label('Sexe')
                    ->options(['M' => 'Masculin', 'F' => 'Féminin']),
                TernaryFilter::make('est_actif')
                    ->label('Actif'),
                TernaryFilter::make('est_archive')
                    ->label('Archivé'),
            ])
            ->recordActions([
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('nom');
    }
}