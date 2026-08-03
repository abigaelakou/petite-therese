<?php

namespace App\Filament\Resources\Inscriptions;

use App\Filament\Resources\Inscriptions\Pages\CreateInscription;
use App\Filament\Resources\Inscriptions\Pages\EditInscription;
use App\Filament\Resources\Inscriptions\Pages\ListInscriptions;
use App\Filament\Resources\Inscriptions\Schemas\InscriptionForm;
use App\Filament\Resources\Inscriptions\Tables\InscriptionsTable;
use App\Models\Inscription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static ?string $navigationLabel = 'Inscriptions';
    protected static ?string $modelLabel = 'Inscription';
    protected static ?string $pluralModelLabel = 'Inscriptions';
    protected static ?int $navigationSort = 4;
    protected static ?string $recordTitleAttribute = 'date_inscription';

    public static function getNavigationGroup(): ?string
    {
        return 'Scolarité';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Inscription::where('statut', 'en_attente')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return InscriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InscriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListInscriptions::route('/'),
            'create' => CreateInscription::route('/create'),
            'edit'   => EditInscription::route('/{record}/edit'),
        ];
    }
}