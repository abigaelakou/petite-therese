<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
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

class UsersTable
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

                TextColumn::make('name')
                    ->label('Nom complet')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copié !'),

                TextColumn::make('telephone')
                    ->label('Téléphone')
                    ->copyable()
                    ->default('—'),

                BadgeColumn::make('roles.name')
                    ->label('Rôle')
                    ->colors([
                        'danger'  => 'super_admin',
                        'primary' => 'directeur',
                        'warning' => 'comptable',
                        'success' => 'enseignant',
                        'info'    => 'parent',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'super_admin' => '👑 Super Admin',
                        'directeur'  => '🎓 Directeur',
                        'comptable'  => '💰 Comptable',
                        'enseignant' => '📚 Enseignant',
                        'parent'     => '👨‍👩‍👧 Parent',
                        default      => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('Rôle')
                    ->relationship('roles', 'name')
                    ->options([
                        'directeur'  => 'Directeur',
                        'comptable'  => 'Comptable',
                        'enseignant' => 'Enseignant',
                        'parent'     => 'Parent',
                    ]),
            ])
            ->recordActions([
                Action::make('reset_password')
                    ->label('Réinitialiser MDP')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Réinitialiser le mot de passe ?')
                    ->modalDescription('Un nouveau mot de passe temporaire sera généré.')
                    ->action(function ($record) {
                        $newPassword = 'LPT' . rand(1000, 9999);
                        $record->update(['password' => bcrypt($newPassword)]);
                        Notification::make()
                            ->title('Mot de passe réinitialisé')
                            ->body('Nouveau mot de passe temporaire : ' . $newPassword)
                            ->success()
                            ->persistent()
                            ->send();
                    }),

                EditAction::make()->label('Modifier'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('name');
    }
}