<?php

namespace App\Filament\Resources\PreInscriptions;

use App\Filament\Resources\PreInscriptions\Pages\CreatePreInscription;
use App\Filament\Resources\PreInscriptions\Pages\EditPreInscription;
use App\Filament\Resources\PreInscriptions\Pages\ListPreInscriptions;
use App\Filament\Resources\PreInscriptions\Schemas\PreInscriptionForm;
use App\Filament\Resources\PreInscriptions\Tables\PreInscriptionsTable;
use App\Models\PreInscription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PreInscriptionResource extends Resource
{
    protected static ?string $model = PreInscription::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $navigationLabel = 'Pré-inscriptions';
    protected static ?string $modelLabel = 'Pré-inscription';
    protected static ?string $pluralModelLabel = 'Pré-inscriptions';
    protected static ?int $navigationSort = 4;
    protected static ?string $recordTitleAttribute = 'nom_eleve';

    public static function getNavigationBadge(): ?string
    {
        return (string) PreInscription::where('statut', 'en_attente')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return PreInscriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PreInscriptionsTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Site vitrine';
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPreInscriptions::route('/'),
            'create'  => CreatePreInscription::route('/create'),
            'edit'  => EditPreInscription::route('/{record}/edit'),
        ];
    }
}