<?php

namespace App\Filament\Resources\ForestResource\Pages;

use App\Filament\Resources\ForestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForests extends ListRecords
{
    protected static string $resource = ForestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
