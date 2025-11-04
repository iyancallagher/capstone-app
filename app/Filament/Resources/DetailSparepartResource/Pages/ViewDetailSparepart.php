<?php

namespace App\Filament\Resources\DetailSparepartResource\Pages;

use App\Filament\Resources\DetailSparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDetailSparepart extends ViewRecord
{
    protected static string $resource = DetailSparepartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
