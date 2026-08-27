<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_couverture')
                    ->label('Photo')
                    ->disk('public')
                    ->height(50)
                    ->width(80),

                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),

                BadgeColumn::make('categorie')
                    ->label('Catégorie')
                    ->colors([
                        'success' => 'evenement',
                        'warning' => 'sortie_pedagogique',
                        'primary' => 'remise_prix',
                        'info'    => 'fete_scolaire',
                        'danger'  => 'sport',
                        'gray'    => 'annonce',
                    ])
                    ->formatStateUsing(fn($state) => Article::CATEGORIES[$state] ?? $state),

                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'gray'    => 'brouillon',
                        'success' => 'publie',
                    ])
                    ->formatStateUsing(fn($state) => Article::STATUTS[$state] ?? $state),

                TextColumn::make('vues')
                    ->label('Vues')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('publie_le')
                    ->label('Publié le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('auteur.name')
                    ->label('Auteur')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('categorie')
                    ->label('Catégorie')
                    ->options(Article::CATEGORIES),
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Article::STATUTS),
            ])
            ->recordActions([
                Action::make('publier')
                    ->label('Publier')
                    ->icon('heroicon-o-globe-alt')
                    ->color('success')
                    ->visible(fn($record) => $record->statut === 'brouillon')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'statut'    => 'publie',
                            'publie_le' => now(),
                        ]);
                        Notification::make()->title('Article publié !')->success()->send();
                    }),

                Action::make('voir')
                    ->label('Voir sur le site')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record) => $record->statut === 'publie')
                    ->url(fn($record) => route('vie-scolaire.show', $record->slug))
                    ->openUrlInNewTab(),

                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}