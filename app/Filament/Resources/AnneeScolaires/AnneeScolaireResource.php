<?php

namespace App\Filament\Resources\AnneeScolaires;

use App\Filament\Resources\AnneeScolaires\Pages\CreateAnneeScolaire;
use App\Filament\Resources\AnneeScolaires\Pages\EditAnneeScolaire;
use App\Filament\Resources\AnneeScolaires\Pages\ListAnneeScolaires;
use App\Filament\Resources\AnneeScolaires\Schemas\AnneeScolaireForm;
use App\Filament\Resources\AnneeScolaires\Tables\AnneeScolairesTable;
use App\Models\AnneeScolaire;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnneeScolaireResource extends Resource
{
    protected static ?string $model = AnneeScolaire::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?string $navigationLabel = 'Années scolaires';
    protected static ?string $modelLabel = 'Année scolaire';
    protected static ?string $pluralModelLabel = 'Années scolaires';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'libelle';

    public static function getNavigationGroup(): ?string
    {
        return 'Scolarité';
    }

    public static function form(Schema $schema): Schema
    {
        return AnneeScolaireForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnneeScolairesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListAnneeScolaires::route('/'),
            'create' => CreateAnneeScolaire::route('/create'),
            'edit'   => EditAnneeScolaire::route('/{record}/edit'),
        ];
    }
}