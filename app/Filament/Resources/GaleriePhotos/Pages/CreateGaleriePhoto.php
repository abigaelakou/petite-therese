<?php

namespace App\Filament\Resources\GaleriePhotos\Pages;

use App\Filament\Resources\GaleriePhotos\GaleriePhotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGaleriePhoto extends CreateRecord
{
    protected static string $resource = GaleriePhotoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Photo ajoutée avec succès !';
    }
}