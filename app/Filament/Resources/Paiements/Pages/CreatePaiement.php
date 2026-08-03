<?php

namespace App\Filament\Resources\Paiements\Pages;

use App\Filament\Resources\Paiements\PaiementResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaiement extends CreateRecord
{
    protected static string $resource = PaiementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Paiement enregistré avec succès !';
    }
}