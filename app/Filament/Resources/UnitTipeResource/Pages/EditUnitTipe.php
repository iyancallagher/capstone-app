<?php

namespace App\Filament\Resources\UnitTipeResource\Pages;

use App\Filament\Resources\UnitTipeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnitTipe extends EditRecord
{
    protected static string $resource = UnitTipeResource::class;
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
        ];
    }
}
