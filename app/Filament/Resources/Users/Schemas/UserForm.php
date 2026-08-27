<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations personnelles')
                ->description('Informations du compte utilisateur.')
                ->icon('heroicon-o-user')
                ->schema([
                    TextInput::make('name')
                        ->label('Nom complet')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('ex: M. KONAN Jean'),

                    TextInput::make('email')
                        ->label('Adresse email')
                        ->email()
                        ->required()
                        ->unique(User::class, 'email', ignoreRecord: true)
                        ->maxLength(100),

                    TextInput::make('telephone')
                        ->label('Téléphone')
                        ->tel()
                        ->maxLength(20)
                        ->placeholder('+225 07 00 00 00 00'),

                    FileUpload::make('photo')
                        ->label('Photo de profil')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1'])
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth('300')
                        ->imageResizeTargetHeight('300')
                        ->directory('profiles')
                        ->visibility('public')
                        ->maxSize(2048),

                ])->columns(2),

            Section::make('Rôle & Accès')
                ->description('Définissez le rôle et les droits d\'accès de l\'utilisateur.')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    Select::make('roles')
                        ->label('Rôle')
                        ->options([
                            'directeur'  => '🎓 Directeur des Études',
                            'comptable'  => '💰 Comptable',
                            'enseignant' => '📚 Enseignant',
                            'parent'     => '👨‍👩‍👧 Parent / Tuteur',
                        'secretaire' => '📋 Secrétaire',
                        ])
                        ->required()
                        ->native(false)
                        ->helperText('Le rôle Super Admin ne peut être attribué que manuellement.')
                        ->dehydrated(false)
                        ->afterStateHydrated(function ($state, $record, callable $set) {
                            if ($record) {
                                $set('roles', $record->getRoleNames()->first());
                            }
                        }),
                ])->columns(1),

            Section::make('Mot de passe')
                ->description('Laissez vide pour ne pas modifier le mot de passe.')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    TextInput::make('password')
                        ->label('Mot de passe')
                        ->password()
                        ->revealable()
                        ->minLength(8)
                        ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                        ->dehydrated(fn($state) => filled($state))
                        ->required(fn(string $operation) => $operation === 'create')
                        ->placeholder(fn(string $operation) => $operation === 'edit' ? 'Laisser vide pour ne pas changer' : 'Mot de passe'),

                    TextInput::make('password_confirmation')
                        ->label('Confirmer le mot de passe')
                        ->password()
                        ->revealable()
                        ->same('password')
                        ->dehydrated(false)
                        ->required(fn(string $operation) => $operation === 'create'),
                ])->columns(2)
                ->collapsible(),

        ]);
    }
}