<?php

namespace App\Filament\Resources\GaleriePhotos\Tables;

use App\Models\GaleriePhoto;
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

class GaleriePhotosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Photo')->disk('public')->height(60)->width(80),
                TextColumn::make('titre')->label('Titre')->searchable()->default('—'),
                BadgeColumn::make('categorie')->label('Catégorie')
                    ->colors([
                        'primary' => 'vie_scolaire',
                        'success' => 'fete_scolaire',
                        'warning' => 'sport',
                        'danger'  => 'remise_prix',
                        'info'    => 'sortie_pedagogique',
                    ])
                    ->formatStateUsing(fn($state) => GaleriePhoto::CATEGORIES[$state] ?? $state),
                TextColumn::make('ordre')->label('Ordre')->sortable(),
                IconColumn::make('est_visible')->label('Visible')->boolean(),
                TextColumn::make('created_at')->label('Ajoutée le')->date('d/m/Y')->sortable(),
            ])
            ->filters([
                SelectFilter::make('categorie')->label('Catégorie')->options(GaleriePhoto::CATEGORIES),
                TernaryFilter::make('est_visible')->label('Visible'),
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