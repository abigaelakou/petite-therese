<?php

namespace App\Filament\Resources\Eleves\Pages;

use App\Filament\Resources\Eleves\EleveResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEleve extends CreateRecord
{
    protected static string $resource = EleveResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Dossier élève créé avec succès !';
    }
}