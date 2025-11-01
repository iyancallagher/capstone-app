<?php

namespace App\Filament\Resources\JenisUnitResource\Pages;

use App\Filament\Resources\JenisUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisUnit extends EditRecord
{
    protected static string $resource = JenisUnitResource::class;
        protected function getRedirectUrl(): string
        {
            return static::getResource()::getUrl('index');
        }

    protected function getCreatedNotificationRedirectUrl(): ?string
        {
            return static::getResource()::getUrl('index');
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
