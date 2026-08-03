<?php

namespace App\Filament\Resources\Eleves\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EleveForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Identité de l\'élève')
                ->description('Informations personnelles de l\'élève.')
                ->icon('heroicon-o-user')
                ->schema([
                    TextInput::make('nom')
                        ->label('Nom')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('Nom de famille'),

                    TextInput::make('prenoms')
                        ->label('Prénoms')
                        ->required()
                        ->maxLength(150)
                        ->placeholder('Prénoms'),

                    DatePicker::make('date_naissance')
                        ->label('Date de naissance')
                        ->required()
                        ->displayFormat('d/m/Y')
                        ->maxDate(now()),

                    TextInput::make('lieu_naissance')
                        ->label('Lieu de naissance')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('ex: Abidjan'),

                    Select::make('sexe')
                        ->label('Sexe')
                        ->options(['M' => 'Masculin', 'F' => 'Féminin'])
                        ->required(),

                    TextInput::make('numero_extrait_naissance')
                        ->label('N° Extrait de naissance')
                        ->maxLength(50)
                        ->placeholder('Numéro de l\'acte'),

                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Photo')
                ->icon('heroicon-o-camera')
                ->schema([
                    FileUpload::make('photo')
                        ->label('Photo de l\'élève')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1'])
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth('300')
                        ->imageResizeTargetHeight('300')
                        ->directory('eleves')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->helperText('Photo redimensionnée automatiquement en 300x300px.')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->collapsible(),

            Section::make('Informations du parent / tuteur')
                ->description('Coordonnées du responsable légal de l\'élève.')
                ->icon('heroicon-o-phone')
                ->schema([
                    TextInput::make('nom_parent')
                        ->label('Nom & Prénoms du parent')
                        ->required()
                        ->maxLength(150)
                        ->placeholder('Nom complet du parent ou tuteur'),

                    TextInput::make('telephone_parent')
                        ->label('Téléphone principal')
                        ->required()
                        ->maxLength(20)
                        ->placeholder('ex: 07 00 00 00 00')
                        ->tel(),

                    TextInput::make('telephone_parent_2')
                        ->label('Téléphone secondaire')
                        ->maxLength(20)
                        ->placeholder('ex: 05 00 00 00 00')
                        ->tel(),

                    TextInput::make('email_parent')
                        ->label('Email du parent')
                        ->email()
                        ->maxLength(100)
                        ->placeholder('email@exemple.com'),

                    TextInput::make('profession_parent')
                        ->label('Profession')
                        ->maxLength(100)
                        ->placeholder('ex: Commerçant, Enseignant...'),

                    TextInput::make('adresse_parent')
                        ->label('Adresse')
                        ->maxLength(200)
                        ->placeholder('Quartier, ville...'),

                ])
                ->columns(2)
                ->columnSpanFull(),

        ]);
    }
}