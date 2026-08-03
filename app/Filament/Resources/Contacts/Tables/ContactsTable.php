<?php

namespace App\Filament\Resources\Contacts\Tables;

use App\Models\Contact;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->label('Téléphone'),
                TextColumn::make('sujet')
                    ->label('Sujet')
                    ->limit(40)
                    ->searchable(),
                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'danger'  => 'non_lu',
                        'warning' => 'lu',
                        'success' => 'traite',
                    ])
                    ->formatStateUsing(fn($state) => Contact::STATUTS[$state] ?? $state),
                TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Contact::STATUTS),
            ])
            ->recordActions([
                Action::make('marquer_lu')
                    ->label('Marquer lu')
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->visible(fn($record) => $record->statut === 'non_lu')
                    ->action(fn($record) => $record->update(['statut' => 'lu'])),
                EditAction::make()->label('Traiter'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}