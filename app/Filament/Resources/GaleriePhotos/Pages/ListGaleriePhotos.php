<?php

namespace App\Filament\Resources\GaleriePhotos\Pages;

use App\Filament\Resources\GaleriePhotos\GaleriePhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGaleriePhotos extends ListRecords
{
    protected static string $resource = GaleriePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
