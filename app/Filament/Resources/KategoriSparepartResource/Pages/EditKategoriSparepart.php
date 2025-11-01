<?php

namespace App\Filament\Resources\KategoriSparepartResource\Pages;

use App\Filament\Resources\KategoriSparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSparepart extends EditRecord
{
    protected static string $resource = KategoriSparepartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
