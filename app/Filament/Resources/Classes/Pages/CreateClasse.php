<?php

namespace App\Filament\Resources\Classes\Pages;

use App\Filament\Resources\Classes\ClasseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClasse extends CreateRecord
{
    protected static string $resource = ClasseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Classe créée avec succès !';
    }
}