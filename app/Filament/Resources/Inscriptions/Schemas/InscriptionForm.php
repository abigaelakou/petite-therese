<?php

namespace App\Filament\Resources\Inscriptions\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Inscription de l\'élève')
                ->description('Inscrivez un élève dans une classe pour une année scolaire.')
                ->icon('heroicon-o-clipboard-document-check')
                ->schema([

                    Select::make('eleve_id')
                        ->label('Élève')
                        ->options(
                            Eleve::where('est_actif', true)
                                ->where('est_archive', false)
                                ->orderBy('nom')
                                ->get()
                                ->mapWithKeys(fn($e) => [$e->id => $e->nom . ' ' . $e->prenoms . ' — ' . $e->matricule])
                        )
                        ->required()
                        ->searchable()
                        ->placeholder('Rechercher un élève...')
                        ->columnSpan(2),

                    Select::make('annee_scolaire_id')
                        ->label('Année scolaire')
                        ->options(
                            AnneeScolaire::where('est_archivee', false)
                                ->orderBy('libelle', 'desc')
                                ->pluck('libelle', 'id')
                        )
                        ->required()
                        ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id)
                        ->columnSpan(1),

                    Select::make('classe_id')
                        ->label('Classe')
                        ->options(
                            Classe::with('anneeScolaire')
                                ->get()
                                ->mapWithKeys(fn($c) => [
                                    $c->id => $c->nom . ' — ' . ($c->anneeScolaire?->libelle ?? '')
                                ])
                        )
                        ->required()
                        ->searchable()
                        ->placeholder('Sélectionner une classe')
                        ->columnSpan(1),

                    Select::make('type')
                        ->label('Type d\'inscription')
                        ->options(Inscription::TYPES)
                        ->required()
                        ->default('nouvelle')
                        ->columnSpan(1),

                    DatePicker::make('date_inscription')
                        ->label('Date d\'inscription')
                        ->required()
                        ->default(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),

                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Statut & Observations')
                ->description('Statut de validation et notes internes.')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->schema([

                    Select::make('statut')
                        ->label('Statut')
                        ->options(Inscription::STATUTS)
                        ->required()
                        ->default('en_attente')
                        ->columnSpan(1),

                    Textarea::make('observations')
                        ->label('Observations')
                        ->rows(3)
                        ->placeholder('Notes internes sur cette inscription...')
                        ->columnSpan(1),

                ])
                ->columns(2)
                ->columnSpanFull()
                ->collapsible(),

        ]);
    }
}