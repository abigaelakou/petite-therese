<?php

namespace App\Filament\Resources\Circulaires\Tables;

use App\Mail\CirculairePubliee;
use App\Models\Circulaire;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class CirculairesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(60),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'information',
                        'warning' => 'convocation',
                        'success' => 'evenement',
                        'danger'  => 'urgent',
                        'gray'    => 'autre',
                    ])
                    ->formatStateUsing(fn($state) => Circulaire::TYPES[$state] ?? $state),

                BadgeColumn::make('destinataires')
                    ->label('Destinataires')
                    ->colors([
                        'primary' => 'tous',
                        'info'    => 'enseignants',
                        'warning' => 'parents',
                        'success' => 'personnel',
                    ])
                    ->formatStateUsing(fn($state) => Circulaire::DESTINATAIRES[$state] ?? $state),

                BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'gray'    => 'brouillon',
                        'success' => 'publiee',
                        'danger'  => 'archivee',
                    ])
                    ->formatStateUsing(fn($state) => Circulaire::STATUTS[$state] ?? $state),

                TextColumn::make('date_publication')
                    ->label('Publiée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('creePar.name')
                    ->label('Créée par')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options(Circulaire::TYPES),
                SelectFilter::make('statut')
                    ->label('Statut')
                    ->options(Circulaire::STATUTS),
                SelectFilter::make('destinataires')
                    ->label('Destinataires')
                    ->options(Circulaire::DESTINATAIRES),
            ])
            ->recordActions([
                // Publier + envoyer email
                Action::make('publier')
                    ->label('Publier')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn($record) => $record->statut === 'brouillon'
                        && auth()->user()->hasAnyRole(['super_admin', 'directeur']))
                    ->requiresConfirmation()
                    ->modalHeading('Publier cette circulaire ?')
                    ->modalDescription('Un email sera automatiquement envoyé aux destinataires concernés.')
                    ->action(function ($record) {
                        $record->update([
                            'statut'           => 'publiee',
                            'date_publication' => now(),
                        ]);

                        // Envoyer email aux destinataires
                        $destinataires = $record->destinataires;
                        $roles = match($destinataires) {
                            'tous'        => ['directeur', 'enseignant', 'secretaire', 'comptable'],
                            'enseignants' => ['enseignant'],
                            'personnel'   => ['directeur', 'enseignant', 'secretaire', 'comptable'],
                            'parents'     => [],
                            default       => [],
                        };

                        if (!empty($roles)) {
                            $users = User::role($roles)->get();
                            foreach ($users as $user) {
                                try {
                                    Mail::to($user->email)->send(new CirculairePubliee($record));
                                } catch (\Exception $e) {
                                    // Continuer même si un email échoue
                                }
                            }
                        }

                        Notification::make()
                            ->title('Circulaire publiée !')
                            ->body('Email envoyé aux destinataires.')
                            ->success()
                            ->send();
                    }),

                // Imprimer version A4 complète
                Action::make('imprimer_a4')
                    ->label('Imprimer A4')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->url(fn($record) => route('circulaires.pdf', $record))
                    ->openUrlInNewTab(),

                // Imprimer version 3 par page pour parents
                Action::make('imprimer_parents')
                    ->label('Note parents (3/page)')
                    ->icon('heroicon-o-document-duplicate')
                    ->color('warning')
                    ->visible(fn($record) => in_array($record->destinataires, ['tous', 'parents']))
                    ->url(fn($record) => route('circulaires.parents.pdf', $record))
                    ->openUrlInNewTab(),

                // Copier message WhatsApp
                Action::make('whatsapp')
                    ->label('Message WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->visible(fn($record) => $record->statut === 'publiee')
                    ->action(function ($record) {
                        $message = "📢 *GSCA La Petite Thérèse*\n\n"
                            . "*" . $record->titre . "*\n\n"
                            . strip_tags($record->contenu) . "\n\n"
                            . "_La Direction_\n"
                            . "_" . ($record->date_publication?->format('d/m/Y') ?? now()->format('d/m/Y')) . "_";

                        Notification::make()
                            ->title('Message WhatsApp prêt !')
                            ->body('Copiez le texte depuis la page imprimée.')
                            ->info()
                            ->send();
                    })
                    ->url(fn($record) => route('circulaires.whatsapp', $record))
                    ->openUrlInNewTab(),

                EditAction::make()
                    ->label('Modifier')
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'directeur', 'secretaire'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}