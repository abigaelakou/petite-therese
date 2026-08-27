<?php

namespace App\Filament\Resources\Certificats;

use App\Filament\Resources\Certificats\Pages\CreateCertificat;
use App\Filament\Resources\Certificats\Pages\EditCertificat;
use App\Filament\Resources\Certificats\Pages\ListCertificats;
use App\Filament\Resources\Certificats\Pages\ViewCertificat;
use App\Filament\Resources\Certificats\Schemas\CertificatForm;
use App\Filament\Resources\Certificats\Tables\CertificatsTable;
use App\Models\Certificat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CertificatResource extends Resource
{
    protected static ?string $model = Certificat::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;
    protected static ?string $navigationLabel = 'Certificats';
    protected static ?string $modelLabel = 'Certificat';
    protected static ?string $pluralModelLabel = 'Certificats de scolarité';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'numero_certificat';

    public static function getNavigationGroup(): ?string
    {
        return 'Scolarité';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return CertificatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCertificats::route('/'),
            'create' => CreateCertificat::route('/create'),
            'view'   => ViewCertificat::route('/{record}'),
            'edit'   => EditCertificat::route('/{record}/edit'),
        ];
    }
}