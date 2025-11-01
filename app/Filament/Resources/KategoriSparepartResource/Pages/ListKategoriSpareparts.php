<?php

namespace App\Filament\Resources\KategoriSparepartResource\Pages;

use App\Filament\Resources\KategoriSparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriSpareparts extends ListRecords
{
    protected static string $resource = KategoriSparepartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
