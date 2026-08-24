<?php

namespace App\Filament\Resources\Documents\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Document;
use App\Models\Eleve;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations du document')
                ->description('Associez un document officiel à un élève.')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Select::make('eleve_id')
                        ->label('Élève')
                        ->options(
                            Eleve::where('est_actif', true)
                                ->where('est_archive', false)
                                ->orderBy('nom')
                                ->get()
                                ->mapWithKeys(fn($e) => [
                                    $e->id => $e->nom . ' ' . $e->prenoms . ' — ' . $e->matricule
                                ])
                        )
                        ->required()
                        ->searchable()
                        ->placeholder('Rechercher un élève...')
                        ->columnSpan(2),

                    Select::make('type')
                        ->label('Type de document')
                        ->options(Document::TYPES)
                        ->required()
                        ->columnSpan(1),

                    Select::make('annee_scolaire_id')
                        ->label('Année scolaire')
                        ->options(
                            AnneeScolaire::orderBy('libelle', 'desc')
                                ->pluck('libelle', 'id')
                        )
                        ->nullable()
                        ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id)
                        ->columnSpan(1),

                ])->columns(2),

            Section::make('Fichier')
                ->description('Uploadez le document (PDF, image ou Word).')
                ->icon('heroicon-o-paper-clip')
                ->schema([
                    FileUpload::make('chemin_fichier')
                        ->label('Fichier')
                        ->directory('documents')
                        ->visibility('public')
                        ->acceptedFileTypes([
                            'application/pdf',
                            'image/jpeg',
                            'image/png',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ])
                        ->maxSize(10240)
                        ->required()
                        ->helperText('Formats acceptés : PDF, JPG, PNG, Word. Taille max : 10MB')
                        ->columnSpanFull()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $filename = is_array($state) ? array_key_first($state) : $state;
                                $set('nom_fichier', basename($filename));
                            }
                        }),

                    TextInput::make('nom_fichier')
                        ->label('Nom du fichier')
                        ->required()
                        ->maxLength(200)
                        ->placeholder('ex: extrait-naissance-KOUASSI.pdf')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}