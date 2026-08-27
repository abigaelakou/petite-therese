<?php

namespace App\Filament\Resources\Classes;

use App\Filament\Resources\Classes\Pages\ListClasses;
use App\Filament\Resources\Classes\Pages\CreateClasse;
use App\Filament\Resources\Classes\Pages\EditClasse;
use App\Filament\Resources\Classes\Schemas\ClasseForm;
use App\Filament\Resources\Classes\Tables\ClassesTable;
use App\Models\Classe;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;
    protected static ?string $navigationLabel = 'Classes';
    protected static ?string $modelLabel = 'Classe';
    protected static ?string $pluralModelLabel = 'Classes';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'nom';

    public static function getNavigationGroup(): ?string
    {
        return 'Scolarité';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'enseignant', 'secretaire']) ?? false;
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
        return ClasseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListClasses::route('/'),
            'create'  => CreateClasse::route('/create'),
           'edit'   => EditClasse::route('/{record}/edit'),
        ];
    }
}