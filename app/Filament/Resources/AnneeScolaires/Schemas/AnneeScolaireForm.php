<?php

namespace App\Filament\Resources\AnneeScolaires\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AnneeScolaireForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Année scolaire')
                ->description('Définissez les informations de l\'année scolaire.')
                ->icon('heroicon-o-calendar-days')
                ->schema([
                    TextInput::make('libelle')
                        ->label('Libellé de l\'année')
                        ->required()
                        ->placeholder('ex: 2025-2026')
                        ->maxLength(20)
                        ->columnSpan(1),

                    Toggle::make('est_active')
                        ->label('Année scolaire en cours')
                        ->helperText('Une seule année peut être active à la fois. Les autres seront automatiquement désactivées.')
                        ->default(false)
                        ->columnSpan(1),

                    DatePicker::make('date_debut')
                        ->label('Date de début')
                        ->required()
                        ->displayFormat('d/m/Y')
                        ->placeholder('jj/mm/aaaa')
                        ->columnSpan(1),

                    DatePicker::make('date_fin')
                        ->label('Date de fin')
                        ->required()
                        ->displayFormat('d/m/Y')
                        ->placeholder('jj/mm/aaaa')
                        ->columnSpan(1),

                ])
                ->columns(2)
                ->columnSpanFull(),

        ]);
    }
}