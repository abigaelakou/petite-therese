<?php

namespace App\Filament\Resources\Classes\Pages;

use App\Filament\Resources\Classes\ClasseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClasses extends ListRecords
{
    protected static string $resource = ClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
