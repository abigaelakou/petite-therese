<?php

namespace App\Filament\Resources\Paiements;

use App\Filament\Resources\Paiements\Pages\CreatePaiement;
use App\Filament\Resources\Paiements\Pages\EditPaiement;
use App\Filament\Resources\Paiements\Pages\ListPaiements;
use App\Filament\Resources\Paiements\Schemas\PaiementForm;
use App\Filament\Resources\Paiements\Tables\PaiementsTable;
use App\Models\Paiement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaiementResource extends Resource
{
    protected static ?string $model = Paiement::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static ?string $navigationLabel = 'Paiements';
    protected static ?string $modelLabel = 'Paiement';
    protected static ?string $pluralModelLabel = 'Paiements';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'numero_recu';

    public static function getNavigationGroup(): ?string
    {
        return 'Finance';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Paiement::where('statut', 'partiel')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return PaiementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaiementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPaiements::route('/'),
            'create' => CreatePaiement::route('/create'),
            'edit'   => EditPaiement::route('/{record}/edit'),
        ];
    }
}