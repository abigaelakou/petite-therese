<?php

namespace App\Filament\Widgets;

use App\Models\PreInscription;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DernieresPréInscriptions extends BaseWidget
{
    protected static ?string $heading = 'Dernières pré-inscriptions';
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(PreInscription::latest()->limit(5))
            ->columns([
                TextColumn::make('nom_eleve')->label('Élève')->weight('bold'),
                TextColumn::make('niveau_souhaite')->label('Niveau')
                    ->formatStateUsing(fn($state) => PreInscription::NIVEAUX[$state] ?? $state)
                    ->badge()->color('primary'),
                TextColumn::make('nom_parent')->label('Parent'),
                TextColumn::make('telephone')->label('Téléphone')->copyable(),
                BadgeColumn::make('statut')->label('Statut')
                    ->colors(['warning' => 'en_attente', 'success' => 'validee', 'danger' => 'refusee'])
                    ->formatStateUsing(fn($state) => PreInscription::STATUTS[$state] ?? $state),
                TextColumn::make('created_at')->label('Reçue le')->dateTime('d/m/Y H:i'),
            ])
            ->actions([])
            ->paginated(false);
    }
}