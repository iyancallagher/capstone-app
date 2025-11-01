<?php

namespace App\Filament\Resources\JenisUnitResource\Pages;

use App\Filament\Resources\JenisUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisUnits extends ListRecords
{
    protected static string $resource = JenisUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
