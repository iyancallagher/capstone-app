<?php

namespace App\Filament\Resources\DetailSparepartResource\Pages;

use App\Filament\Resources\DetailSparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailSparepart extends EditRecord
{
    protected static string $resource = DetailSparepartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
