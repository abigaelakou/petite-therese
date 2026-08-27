<?php

namespace App\Filament\Resources\Inscriptions\Pages;

use App\Filament\Resources\Inscriptions\InscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInscription extends EditRecord
{
    protected static string $resource = InscriptionResource::class;

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
        return 'Inscription modifiée avec succès !';
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Retour à la liste');
    }
}