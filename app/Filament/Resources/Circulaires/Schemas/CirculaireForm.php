<?php

namespace App\Filament\Resources\Circulaires\Schemas;

use App\Models\Circulaire;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CirculaireForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations de la circulaire')
                ->description('Rédigez et publiez une circulaire à destination du personnel et/ou des parents.')
                ->icon('heroicon-o-megaphone')
                ->schema([
                    TextInput::make('titre')
                        ->label('Titre')
                        ->required()
                        ->maxLength(200)
                        ->placeholder('ex: Réunion de parents — Trimestre 1')
                        ->columnSpanFull(),

                    Select::make('type')
                        ->label('Type')
                        ->options(Circulaire::TYPES)
                        ->required()
                        ->default('information')
                        ->columnSpan(1),

                    Select::make('destinataires')
                        ->label('Destinataires')
                        ->options(Circulaire::DESTINATAIRES)
                        ->required()
                        ->default('tous')
                        ->columnSpan(1),

                    Select::make('statut')
                        ->label('Statut')
                        ->options(Circulaire::STATUTS)
                        ->required()
                        ->default('brouillon')
                        ->reactive()
                        ->columnSpan(1),

                    DateTimePicker::make('date_publication')
                        ->label('Date de publication')
                        ->displayFormat('d/m/Y H:i')
                        ->default(now())
                        ->visible(fn($get) => $get('statut') === 'publiee')
                        ->columnSpan(1),

                ])->columns(2),

            Section::make('Contenu')
                ->icon('heroicon-o-document-text')
                ->schema([
                    RichEditor::make('contenu')
                        ->label('Contenu de la circulaire')
                        ->required()
                        ->toolbarButtons([
                            'bold', 'italic', 'underline',
                            'bulletList', 'orderedList',
                            'h2', 'h3',
                            'link',
                        ])
                        ->columnSpanFull(),
                ]),

            Section::make('Pièce jointe (optionnel)')
                ->icon('heroicon-o-paper-clip')
                ->schema([
                    FileUpload::make('fichier_joint')
                        ->label('Fichier joint')
                        ->directory('circulaires')
                        ->visibility('public')
                        ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                        ->maxSize(5120)
                        ->helperText('PDF ou image. Max 5MB.')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

        ]);
    }
}