<?php

namespace App\Filament\App\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\App\Resources\EmployeeResource;
use App\Filament\App\Resources\EmployeeResource\Widgets\PanelEmployeeOverviewMessage;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PanelEmployeeOverviewMessage::class,
        ];
    }
}
