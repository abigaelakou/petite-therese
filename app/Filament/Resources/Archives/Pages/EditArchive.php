<?php

namespace App\Filament\Resources\Archives\Pages;

use App\Filament\Resources\Archives\ArchiveResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArchive extends EditRecord
{
    protected static string $resource = ArchiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Supprimer'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Archive modifiée avec succès !';
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('Retour à la liste');
    }
}