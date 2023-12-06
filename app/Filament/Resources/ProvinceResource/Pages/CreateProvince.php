<?php

namespace App\Filament\Resources\ProvinceResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProvinceResource;

class CreateProvince extends CreateRecord
{
    protected static string $resource = ProvinceResource::class;

    protected function getCreatedNotification(): ?Notification
    {
         return Notification::make()
         ->success()
         ->title('Provincie is aangemaakt!');
    }
}
