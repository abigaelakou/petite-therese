<?php

namespace App\Filament\Resources\Equipes\Tables;

use App\Models\Equipe;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class EquipesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Photo')->disk('public')
                    ->circular()->defaultImageUrl(asset('assets/img/team/default.jpg')),
                TextColumn::make('nom')->label('Nom')->searchable()->sortable()->weight('bold'),
                TextColumn::make('poste')->label('Poste')->searchable(),
                BadgeColumn::make('categorie')->label('Catégorie')
                    ->colors(['primary' => 'direction', 'success' => 'enseignant', 'warning' => 'staff'])
                    ->formatStateUsing(fn($state) => Equipe::CATEGORIES[$state] ?? $state),
                TextColumn::make('ordre')->label('Ordre')->sortable(),
                IconColumn::make('est_visible')->label('Visible')->boolean(),
                IconColumn::make('est_actif')->label('Actif')->boolean(),
            ])
            ->filters([
                SelectFilter::make('categorie')->label('Catégorie')->options(Equipe::CATEGORIES),
                TernaryFilter::make('est_visible')->label('Visible'),
                TernaryFilter::make('est_actif')->label('Actif'),
            ])
            ->recordActions([
                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('ordre');
    }
}