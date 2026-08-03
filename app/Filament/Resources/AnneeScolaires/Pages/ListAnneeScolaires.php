<?php

namespace App\Filament\Resources\AnneeScolaires\Pages;

use App\Filament\Resources\AnneeScolaires\AnneeScolaireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnneeScolaires extends ListRecords
{
    protected static string $resource = AnneeScolaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
