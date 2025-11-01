<?php

namespace App\Filament\Resources\KategoriKomponenResource\Pages;

use App\Filament\Resources\KategoriKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriKomponen extends EditRecord
{
    protected static string $resource = KategoriKomponenResource::class;
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
