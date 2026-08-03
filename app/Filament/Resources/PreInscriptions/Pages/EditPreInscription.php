<?php

namespace App\Filament\Resources\PreInscriptions\Pages;

use App\Filament\Resources\PreInscriptions\PreInscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPreInscription extends EditRecord
{
    protected static string $resource = PreInscriptionResource::class;

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
        return 'Modifications enregistrées avec succès !';
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Retour à la liste');
    }
}