<?php

namespace App\Filament\Resources\KategoriKomponenResource\Pages;

use App\Filament\Resources\KategoriKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriKomponens extends ListRecords
{
    protected static string $resource = KategoriKomponenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
