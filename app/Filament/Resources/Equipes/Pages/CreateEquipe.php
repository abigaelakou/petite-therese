<?php

namespace App\Filament\Resources\Equipes\Pages;

use App\Filament\Resources\Equipes\EquipeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEquipe extends CreateRecord
{
    protected static string $resource = EquipeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Membre ajouté avec succès !';
    }
}