<?php

namespace App\Filament\Resources\PreInscriptions\Schemas;

use App\Models\PreInscription;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PreInscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Demande reçue du site')
                    ->schema([
                        TextInput::make('nom_eleve')->label('Nom de l\'élève')->disabled(),
                        TextInput::make('niveau_souhaite')->label('Niveau souhaité')->disabled()
                            ->formatStateUsing(fn($state) => PreInscription::NIVEAUX[$state] ?? $state),
                        TextInput::make('nom_parent')->label('Nom du parent')->disabled(),
                        TextInput::make('telephone')->label('Téléphone')->disabled(),
                        TextInput::make('email')->label('Email')->disabled(),
                        TextInput::make('annee_naissance')->label('Année de naissance')->disabled(),
                        Textarea::make('message')->label('Message du parent')
                            ->disabled()->rows(3)->columnSpanFull(),
                    ])->columns(2),

                Section::make('Décision')
                    ->schema([
                        Select::make('statut')
                            ->label('Statut')
                            ->options(PreInscription::STATUTS)
                            ->required(),
                        Textarea::make('observations')
                            ->label('Observations internes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}