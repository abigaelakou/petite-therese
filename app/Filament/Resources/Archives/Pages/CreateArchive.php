<?php

namespace App\Filament\Resources\Archives\Pages;

use App\Filament\Resources\Archives\ArchiveResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArchive extends CreateRecord
{
    protected static string $resource = ArchiveResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Archive créée avec succès !';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['archive_par'] = auth()->id();
        return $data;
    }
}