<?php

namespace App\Filament\Resources\AnneeScolaires\Pages;

use App\Filament\Resources\AnneeScolaires\AnneeScolaireResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnneeScolaire extends CreateRecord
{
    protected static string $resource = AnneeScolaireResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Année scolaire créée avec succès !';
    }
}