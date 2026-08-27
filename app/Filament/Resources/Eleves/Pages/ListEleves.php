<?php

namespace App\Filament\Resources\Eleves\Pages;

use App\Filament\Resources\Eleves\EleveResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEleves extends ListRecords
{
    protected static string $resource = EleveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
