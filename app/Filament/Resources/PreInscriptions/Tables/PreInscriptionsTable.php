<?php

namespace App\Filament\Resources\PreInscriptions\Tables;

use App\Models\Eleve;
use App\Models\PreInscription;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PreInscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom_eleve')
                    ->label('Élève')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('niveau_souhaite')
                    ->label('Niveau')
                    ->formatStateUsing(fn($state) => PreInscription::NIVEAUX[$state] ?? $state)
                    ->badge()
                    ->color('primary'),
                TextColumn::make('nom_parent')
                    ->label('Parent')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->label('Téléphone')
                    ->copyable()
                    ->copyMessage('Numéro copié !'),
                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'en_attente',
                        'success' => 'validee',
                        'danger'  => 'refusee',
                        'info'    => 'liste_attente',
                    ])
                    ->formatStateUsing(fn($state) => PreInscription::STATUTS[$state] ?? $state),
                TextColumn::make('created_at')
                    ->label('Reçue le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(PreInscription::STATUTS),
                SelectFilter::make('niveau_souhaite')
                    ->label('Niveau')
                    ->options(PreInscription::NIVEAUX),
            ])
            ->recordActions([
                Action::make('valider')
                    ->label('Valider & Créer dossier')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->statut === 'en_attente')
                    ->requiresConfirmation()
                    ->modalHeading('Valider cette pré-inscription ?')
                    ->modalDescription('Un dossier élève sera créé automatiquement avec les informations disponibles. Vous pourrez le compléter ensuite.')
                    ->modalSubmitActionLabel('Oui, valider et créer le dossier')
                    ->action(function ($record) {
                        // Créer le dossier élève automatiquement
                        $eleve = Eleve::create([
                            'nom'              => strtoupper(explode(' ', $record->nom_eleve)[0] ?? $record->nom_eleve),
                            'prenoms'          => implode(' ', array_slice(explode(' ', $record->nom_eleve), 1)) ?: 'À compléter',
                            'date_naissance'   => now()->subYears(6),
                            'lieu_naissance'   => 'À compléter',
                            'sexe'             => 'M',
                            'nom_parent'       => $record->nom_parent,
                            'telephone_parent' => $record->telephone,
                            'email_parent'     => $record->email,
                        ]);

                        // Mettre à jour la pré-inscription
                        $record->update([
                            'statut'     => 'validee',
                            'eleve_id'   => $eleve->id,
                            'traite_par' => auth()->id(),
                            'traite_le'  => now(),
                        ]);

                        Notification::make()
                            ->title('Pré-inscription validée !')
                            ->body("Dossier élève créé — Matricule : {$eleve->matricule}. Pensez à compléter les informations manquantes.")
                            ->success()
                            ->send();
                    }),

                Action::make('refuser')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->statut === 'en_attente')
                    ->requiresConfirmation()
                    ->modalHeading('Refuser cette pré-inscription ?')
                    ->modalDescription('Le parent ne sera pas notifié automatiquement. Pensez à le contacter.')
                    ->modalSubmitActionLabel('Oui, refuser')
                    ->action(function ($record) {
                        $record->update([
                            'statut'     => 'refusee',
                            'traite_par' => auth()->id(),
                            'traite_le'  => now(),
                        ]);
                        Notification::make()
                            ->title('Pré-inscription refusée')
                            ->warning()
                            ->send();
                    }),

                EditAction::make()->label('Voir détails'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}