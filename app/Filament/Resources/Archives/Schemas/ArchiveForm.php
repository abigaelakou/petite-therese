<?php

namespace App\Filament\Resources\Archives\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Archive;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArchiveForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations de l\'archive')
                ->description('Archivez tout document important de l\'école. Accès réservé au Super Admin.')
                ->icon('heroicon-o-archive-box')
                ->schema([

                    Select::make('type')
                        ->label('Type de document')
                        ->options(Archive::TYPES)
                        ->required()
                        ->native(false)
                        ->columnSpan(1),

                    Select::make('annee_scolaire_id')
                        ->label('Année scolaire concernée')
                        ->options(
                            AnneeScolaire::orderBy('libelle', 'desc')
                                ->pluck('libelle', 'id')
                        )
                        ->nullable()
                        ->searchable()
                        ->helperText('Optionnel — pour les données scolaires')
                        ->columnSpan(1),

                    Textarea::make('description')
                        ->label('Description du document')
                        ->required()
                        ->rows(3)
                        ->placeholder('ex: Registre de commerce 2025 — Renouvellement annuel\nex: Rapport d\'inspection académique — Octobre 2025\nex: Archivage complet année 2024-2025')
                        ->columnSpanFull(),

                    DateTimePicker::make('archivee_le')
                        ->label('Date d\'archivage')
                        ->required()
                        ->default(now())
                        ->displayFormat('d/m/Y H:i')
                        ->columnSpan(1),

                ])->columns(2),

            Section::make('Fichier')
                ->description('Uploadez le document (PDF, ZIP, image, Word, Excel). Stockage sécurisé et privé.')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    FileUpload::make('chemin_fichier')
                        ->label('Fichier')
                        ->directory('archives')
                        ->visibility('private')
                        ->acceptedFileTypes([
                            'application/pdf',
                            'application/zip',
                            'application/x-zip-compressed',
                            'image/jpeg',
                            'image/png',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->maxSize(51200)
                        ->helperText('Formats : PDF, ZIP, Image, Word, Excel. Taille max : 50MB. Fichier privé — non accessible publiquement.')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}