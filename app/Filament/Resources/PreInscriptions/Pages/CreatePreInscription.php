<?php

namespace App\Filament\Resources\PreInscriptions\Pages;

use App\Filament\Resources\PreInscriptions\PreInscriptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePreInscription extends CreateRecord
{
    protected static string $resource = PreInscriptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pré-inscription ajoutée avec succès !';
    }
}