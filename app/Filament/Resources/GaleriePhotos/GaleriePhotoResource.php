<?php

namespace App\Filament\Resources\GaleriePhotos;

use App\Filament\Resources\GaleriePhotos\Pages\CreateGaleriePhoto;
use App\Filament\Resources\GaleriePhotos\Pages\EditGaleriePhoto;
use App\Filament\Resources\GaleriePhotos\Pages\ListGaleriePhotos;
use App\Filament\Resources\GaleriePhotos\Schemas\GaleriePhotoForm;
use App\Filament\Resources\GaleriePhotos\Tables\GaleriePhotosTable;
use App\Models\GaleriePhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GaleriePhotoResource extends Resource
{
    protected static ?string $model = GaleriePhoto::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?string $navigationLabel = 'Galerie photos';
    protected static ?string $modelLabel = 'Photo';
    protected static ?string $pluralModelLabel = 'Galerie photos';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'titre';

    public static function form(Schema $schema): Schema
    {
        return GaleriePhotoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GaleriePhotosTable::configure($table);
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
            'index'  => ListGaleriePhotos::route('/'),
            'create'  => CreateGaleriePhoto::route('/create'),
            'edit'  => EditGaleriePhoto::route('/{record}/edit'),
        ];
    }
}