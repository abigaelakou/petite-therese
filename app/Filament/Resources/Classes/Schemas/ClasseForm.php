<?php

namespace App\Filament\Resources\Classes\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClasseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations de la classe')
                ->description('Créez ou modifiez une classe pour l\'année scolaire.')
                ->icon('heroicon-o-academic-cap')
                ->schema([

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

                    Select::make('niveau')
                        ->label('Niveau')
                        ->options(Classe::NIVEAUX)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $noms = [
                                'ms'  => 'MS A',  'gs'  => 'GS A',
                                'cp1' => 'CP1 A', 'cp2' => 'CP2 A',
                                'ce1' => 'CE1 A', 'ce2' => 'CE2 A',
                                'cm1' => 'CM1 A', 'cm2' => 'CM2 A',
                            ];
                            if ($state && isset($noms[$state])) {
                                $set('nom', $noms[$state]);
                            }
                        })
                        ->columnSpan(1),

                    TextInput::make('nom')
                        ->label('Nom de la classe')
                        ->required()
                        ->placeholder('ex: MS A, MS B, CP1 A, CP1 B...')
                        ->maxLength(50)
                        ->helperText('Exemples : MS A, MS B, GS A, GS B, CP1 A, CP1 B, CE1 A, CE1 B...')
                        ->columnSpan(1),

                    TextInput::make('capacite')
                        ->label('Capacité maximale')
                        ->numeric()
                        ->default(40)
                        ->minValue(1)
                        ->maxValue(60)
                        ->suffix('élèves')
                        ->columnSpan(1),

                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Enseignant responsable')
                ->description('Assignez un enseignant principal à cette classe.')
                ->icon('heroicon-o-user')
                ->schema([
                    Select::make('enseignant_id')
                        ->label('Enseignant')
                        ->options(User::role('enseignant')->pluck('name', 'id'))
                        ->searchable()
                        ->nullable()
                        ->placeholder('Sélectionner un enseignant')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->collapsible(),

        ]);
    }
}