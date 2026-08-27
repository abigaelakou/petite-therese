<?php

namespace App\Filament\Resources\Circulaires\Pages;

use App\Filament\Resources\Circulaires\CirculaireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCirculaires extends ListRecords
{
    protected static string $resource = CirculaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
