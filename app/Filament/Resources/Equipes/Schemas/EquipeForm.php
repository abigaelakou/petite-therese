<?php

namespace App\Filament\Resources\Equipes\Schemas;

use App\Models\Equipe;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EquipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations personnelles')
                    ->schema([
                        TextInput::make('nom')->label('Nom')->required()->maxLength(100),
                        TextInput::make('prenoms')->label('Prénoms')->maxLength(100),
                        TextInput::make('poste')->label('Poste / Fonction')->required()->maxLength(150)
                            ->placeholder('ex: Directeur Général, Enseignant CM2'),
                        Select::make('categorie')->label('Catégorie')
                            ->options(Equipe::CATEGORIES)->required()->default('enseignant'),
                    ])->columns(2),

                Section::make('Photo')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Photo du membre')
                            ->image()
                            ->imageEditor()
                            ->directory('equipe')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('400')
                            ->imageResizeTargetHeight('400')
                            ->helperText('La photo sera automatiquement redimensionnée en 400x400px.'),
                    ]),

                Section::make('Réseaux sociaux')
                    ->schema([
                        TextInput::make('facebook')->label('Facebook')->url()
                            ->placeholder('https://facebook.com/...'),
                        TextInput::make('whatsapp')->label('WhatsApp')
                            ->placeholder('225XXXXXXXXXX'),
                        TextInput::make('linkedin')->label('LinkedIn')->url()
                            ->placeholder('https://linkedin.com/in/...'),
                        TextInput::make('email')->label('Email')->email(),
                    ])->columns(2),

                Section::make('Affichage')
                    ->schema([
                        Textarea::make('bio')->label('Biographie courte')->rows(3)->maxLength(500),
                        TextInput::make('ordre')->label('Ordre d\'affichage')->numeric()->default(0),
                        Toggle::make('est_visible')->label('Visible sur le site')->default(true),
                        Toggle::make('est_actif')->label('Membre actif')->default(true)
                            ->helperText('Désactiver si le membre a quitté l\'école'),
                    ])->columns(2),
            ]);
    }
}