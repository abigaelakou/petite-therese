<?php

namespace App\Filament\Resources\Inscriptions\Pages;

use App\Filament\Resources\Inscriptions\InscriptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInscription extends CreateRecord
{
    protected static string $resource = InscriptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Inscription créée avec succès !';
    }
}