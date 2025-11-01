<?php

namespace App\Filament\Resources\UnitTipeResource\Pages;

use App\Filament\Resources\UnitTipeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnitTipes extends ListRecords
{
    protected static string $resource = UnitTipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
