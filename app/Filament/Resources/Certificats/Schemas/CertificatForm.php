<?php

namespace App\Filament\Resources\Certificats\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Certificat;
use App\Models\Eleve;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Certificat de scolarité')
                ->description('Générez un certificat de scolarité pour un élève.')
                ->icon('heroicon-o-document-check')
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

                    Select::make('annee_scolaire_id')
                        ->label('Année scolaire')
                        ->options(
                            AnneeScolaire::orderBy('libelle', 'desc')
                                ->pluck('libelle', 'id')
                        )
                        ->required()
                        ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id)
                        ->columnSpan(1),

                    Select::make('statut')
                        ->label('Statut')
                        ->options(Certificat::STATUTS)
                        ->required()
                        ->default('valide')
                        ->columnSpan(1),

                    TextInput::make('motif')
                        ->label('Motif de délivrance')
                        ->default('Usage administratif')
                        ->maxLength(200)
                        ->placeholder('ex: Usage administratif, Inscription université...')
                        ->columnSpan(2),

                ])->columns(2),

        ]);
    }
}