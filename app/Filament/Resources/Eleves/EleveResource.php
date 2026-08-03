<?php

namespace App\Filament\Resources\Eleves;

use App\Filament\Resources\Eleves\Pages\CreateEleve;
use App\Filament\Resources\Eleves\Pages\EditEleve;
use App\Filament\Resources\Eleves\Pages\ListEleves;
use App\Filament\Resources\Eleves\Schemas\EleveForm;
use App\Filament\Resources\Eleves\Tables\ElevesTable;
use App\Models\Eleve;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EleveResource extends Resource
{
    protected static ?string $model = Eleve::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?string $navigationLabel = 'Élèves';
    protected static ?string $modelLabel = 'Élève';
    protected static ?string $pluralModelLabel = 'Élèves';
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'nom';

    public static function getNavigationGroup(): ?string
    {
        return 'Scolarité';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Eleve::where('est_actif', true)->where('est_archive', false)->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return EleveForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ElevesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListEleves::route('/'),
            'create' => CreateEleve::route('/create'),
            'edit'   => EditEleve::route('/{record}/edit'),
        ];
    }
}