<?php

namespace App\Filament\Resources\PreInscriptions\Pages;

use App\Filament\Resources\PreInscriptions\PreInscriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPreInscriptions extends ListRecords
{
    protected static string $resource = PreInscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
