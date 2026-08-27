<?php

namespace App\Filament\Resources\Circulaires\Pages;

use App\Filament\Resources\Circulaires\CirculaireResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCirculaire extends EditRecord
{
    protected static string $resource = CirculaireResource::class;

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
        return 'Circulaire modifiée avec succès !';
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()->label('Retour à la liste');
    }
}