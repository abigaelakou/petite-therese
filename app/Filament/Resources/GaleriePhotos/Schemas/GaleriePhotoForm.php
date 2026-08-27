<?php

namespace App\Filament\Resources\GaleriePhotos\Schemas;

use App\Models\GaleriePhoto;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GaleriePhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Photo')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->imageEditor()
                            ->directory('galerie')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->required()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('600')
                            ->helperText('La photo sera automatiquement redimensionnée en 800x600px.'),
                    ]),

                Section::make('Informations')
                    ->schema([
                        TextInput::make('titre')->label('Titre (optionnel)')->maxLength(150)
                            ->placeholder('ex: Fête de fin d\'année 2024'),
                        Select::make('categorie')->label('Catégorie')
                            ->options(GaleriePhoto::CATEGORIES)->required()->default('vie_scolaire'),
                        Textarea::make('description')->label('Description (optionnel)')->rows(2)->maxLength(300),
                        TextInput::make('ordre')->label('Ordre d\'affichage')->numeric()->default(0),
                        Toggle::make('est_visible')->label('Visible sur le site')->default(true),
                    ])->columns(2),
            ]);
    }
}