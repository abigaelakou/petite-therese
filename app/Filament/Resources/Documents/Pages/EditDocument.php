<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

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
        return 'Document modifié avec succès !';
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('Retour à la liste');
    }
}