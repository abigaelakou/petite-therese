<?php

namespace App\Filament\Resources\Equipes;

use App\Filament\Resources\Equipes\Pages\ListEquipes;
use App\Filament\Resources\Equipes\Pages\CreateEquipe;
use App\Filament\Resources\Equipes\Pages\EditEquipe;
use App\Filament\Resources\Equipes\Schemas\EquipeForm;
use App\Filament\Resources\Equipes\Tables\EquipesTable;
use App\Models\Equipe;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class EquipeResource extends Resource
{
    protected static ?string $model = Equipe::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static ?string $navigationLabel = 'Équipe';
    protected static ?string $modelLabel = 'Équipe';
    protected static ?string $pluralModelLabel = 'Équipe';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'nom';

    public static function getNavigationGroup(): ?string
    {
        return 'Site vitrine';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return EquipeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EquipesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListEquipes::route('/'),
            'create'  => CreateEquipe::route('/create'),
            'edit'   => EditEquipe::route('/{record}/edit'),
        ];
    }
}