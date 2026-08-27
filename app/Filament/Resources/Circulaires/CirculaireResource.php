<?php

namespace App\Filament\Resources\Circulaires;

use App\Filament\Resources\Circulaires\Pages\CreateCirculaire;
use App\Filament\Resources\Circulaires\Pages\EditCirculaire;
use App\Filament\Resources\Circulaires\Pages\ListCirculaires;
use App\Filament\Resources\Circulaires\Schemas\CirculaireForm;
use App\Filament\Resources\Circulaires\Tables\CirculairesTable;
use App\Models\Circulaire;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CirculaireResource extends Resource
{
    protected static ?string $model = Circulaire::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;
    protected static ?string $navigationLabel = 'Circulaires';
    protected static ?string $modelLabel = 'Circulaire';
    protected static ?string $pluralModelLabel = 'Circulaires';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'titre';

    public static function getNavigationGroup(): ?string
    {
        return 'Communication';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Circulaire::where('statut', 'publiee')
            ->where('date_publication', '>=', now()->subDays(7))
            ->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    // Voir : tout le personnel
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole([
            'super_admin', 'directeur', 'enseignant',
            'secretaire', 'comptable'
        ]) ?? false;
    }

    // Créer : directeur + secrétaire
    public static function canCreate(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    // Modifier : directeur + secrétaire
    public static function canEdit($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    // Supprimer : directeur uniquement
    public static function canDelete($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return CirculaireForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CirculairesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCirculaires::route('/'),
            'create' => CreateCirculaire::route('/create'),
            'edit'   => EditCirculaire::route('/{record}/edit'),
        ];
    }
}