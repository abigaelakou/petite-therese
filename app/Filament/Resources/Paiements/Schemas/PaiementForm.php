<?php

namespace App\Filament\Resources\Paiements\Schemas;

use App\Models\AnneeScolaire;
use App\Models\Eleve;
use App\Models\Paiement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaiementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ── ALERTE SOLDE IMPAYÉ ──────────────────────────────────
            Section::make('⚠️ Vérification solde précédent')
                ->description('Vérifiez si l\'élève a un solde impayé de l\'année précédente.')
                ->icon('heroicon-o-exclamation-triangle')
                ->schema([
                    Select::make('eleve_check')
                        ->label('Vérifier un élève')
                        ->options(
                            Eleve::where('est_actif', true)
                                ->orderBy('nom')
                                ->get()
                                ->mapWithKeys(fn($e) => [
                                    $e->id => $e->nom . ' ' . $e->prenoms . ' — ' . $e->matricule
                                ])
                        )
                        ->searchable()
                        ->placeholder('Sélectionner un élève pour vérifier...')
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $info = Paiement::soldeAnneePrecedente((int)$state);
                                if ($info['solde'] > 0) {
                                    $set('eleve_id', $state);
                                    $set('montant_reporte', $info['solde']);
                                    $set('annee_precedente_id', $info['annee']?->id);
                                } else {
                                    $set('eleve_id', $state);
                                    $set('montant_reporte', 0);
                                }
                            }
                        })
                        ->columnSpanFull(),

                    Placeholder::make('alerte_solde')
                        ->label('')
                        ->content(function (callable $get) {
                            $eleveId = $get('eleve_check');
                            if (!$eleveId) return '— Sélectionnez un élève pour voir son solde —';
                            $info = Paiement::soldeAnneePrecedente((int)$eleveId);
                            if ($info['solde'] > 0) {
                                return '⚠️ CET ÉLÈVE A UN SOLDE IMPAYÉ DE ' .
                                    number_format($info['solde'], 0, ',', ' ') . ' FCFA' .
                                    ' sur l\'année ' . ($info['annee']?->libelle ?? 'précédente') .
                                    '. Ce montant sera ajouté au paiement.';
                            }
                            return '✓ Aucun solde impayé détecté pour cet élève.';
                        })
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->collapsible(),

            // ── INFORMATIONS PAIEMENT ────────────────────────────────
            Section::make('Informations du paiement')
                ->description('Enregistrez le paiement.')
                ->icon('heroicon-o-banknotes')
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
                            AnneeScolaire::where('est_archivee', false)
                                ->orderBy('libelle', 'desc')
                                ->pluck('libelle', 'id')
                        )
                        ->required()
                        ->default(fn() => AnneeScolaire::where('est_active', true)->first()?->id)
                        ->columnSpan(1),

                    Select::make('type')
                        ->label('Type de paiement')
                        ->options(Paiement::TYPES)
                        ->required()
                        ->columnSpan(1),

                    DatePicker::make('date_paiement')
                        ->label('Date du paiement')
                        ->required()
                        ->default(now())
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),

                    Select::make('mode_paiement')
                        ->label('Mode de paiement')
                        ->options(Paiement::MODES)
                        ->required()
                        ->default('especes')
                        ->reactive()
                        ->columnSpan(1),

                    TextInput::make('reference_mobile_money')
                        ->label('Référence transaction')
                        ->maxLength(50)
                        ->placeholder('ex: CI240803XXXXXX')
                        ->helperText('Numéro de référence affiché sur le téléphone du parent après paiement Wave/MTN/Moov')
                        ->visible(fn($get) => in_array($get('mode_paiement'), ['mobile_money', 'wave']))
                        ->columnSpan(2),

                ])
                ->columns(2)
                ->columnSpanFull(),

            // ── MONTANTS ─────────────────────────────────────────────
            Section::make('Montants')
                ->description('Saisissez les montants en FCFA.')
                ->icon('heroicon-o-calculator')
                ->schema([

                    TextInput::make('montant_reporte')
                        ->label('Solde reporté année précédente (FCFA)')
                        ->numeric()
                        ->default(0)
                        ->suffix('FCFA')
                        ->disabled()
                        ->dehydrated()
                        ->helperText('Calculé automatiquement depuis l\'année précédente')
                        ->columnSpan(1),

                    TextInput::make('montant_attendu')
                        ->label('Montant attendu (FCFA)')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('ex: 50000')
                        ->suffix('FCFA')
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $paye = (float)($get('montant_paye') ?? 0);
                            $set('reste_a_payer', max(0, (float)$state - $paye));
                        })
                        ->columnSpan(1),

                    TextInput::make('montant_paye')
                        ->label('Montant payé aujourd\'hui (FCFA)')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('ex: 25000')
                        ->suffix('FCFA')
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $attendu = (float)($get('montant_attendu') ?? 0);
                            $set('reste_a_payer', max(0, $attendu - (float)$state));
                        })
                        ->columnSpan(1),

                    TextInput::make('reste_a_payer')
                        ->label('Reste à payer (FCFA)')
                        ->numeric()
                        ->default(0)
                        ->suffix('FCFA')
                        ->disabled()
                        ->dehydrated()
                        ->helperText('Calculé automatiquement')
                        ->columnSpan(1),

                ])
                ->columns(2)
                ->columnSpanFull(),

            // ── OBSERVATIONS ─────────────────────────────────────────
            Section::make('Observations')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->schema([
                    Textarea::make('observations')
                        ->label('Observations')
                        ->rows(3)
                        ->placeholder('Notes internes sur ce paiement...')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull()
                ->collapsible(),

        ]);
    }
}