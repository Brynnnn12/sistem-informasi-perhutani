<?php

namespace App\Filament\Resources\ForestResource\Pages;

use App\Filament\Resources\ForestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForest extends EditRecord
{
    protected static string $resource = ForestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
