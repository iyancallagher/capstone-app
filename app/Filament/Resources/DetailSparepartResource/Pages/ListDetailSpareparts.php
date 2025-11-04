<?php

namespace App\Filament\Resources\DetailSparepartResource\Pages;

use App\Filament\Resources\DetailSparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailSpareparts extends ListRecords
{
    protected static string $resource = DetailSparepartResource::class;

    protected function getHeaderActions(): array
    {
        return [
             Actions\Action::make('createSparepart')
                ->label('Tambah Sparepart Baru')
                // arahkan ke resource lain
                ->url(route('filament.warehouse.resources.spareparts.create')), 
                
        ];
    }
}
