<?php

namespace App\Filament\Resources\SparepartResource\Pages;

use App\Filament\Resources\SparepartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSparepart extends EditRecord
{
    protected static string $resource = SparepartResource::class;
protected function mutateFormDataBeforeFill(array $data): array
{
    $data['detailSpareparts'] = $this->record->detailSpareparts->map(function ($item) {
        return [
            'id' => $item->id,
            'jenis_unit_id' => $item->jenis_unit_id,
            'catatan' => $item->catatan,
        ];
    })->toArray();

    return $data;
}
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    
}
