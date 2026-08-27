<?php

namespace App\Filament\Resources\Circulaires\Pages;

use App\Filament\Resources\Circulaires\CirculaireResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCirculaire extends CreateRecord
{
    protected static string $resource = CirculaireResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Circulaire créée avec succès !';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['cree_par'] = auth()->id();
        return $data;
    }
}