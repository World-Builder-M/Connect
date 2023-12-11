<?php

namespace App\Filament\App\Resources\EmployeeResource\Pages;

use Filament\Actions;
use App\Models\Employee;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
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

    public function getTabs(): array
    {

        /**
         *  ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true); 

            In the AppPanelProvider, so we don't have to worry about this query
        */

        $tabs = [
            'Alle' => Tab::make(),
            'Vandaag' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('hired_at', '>=', now()->today()))
                ->badge(Employee::query()->where('hired_at', '>=', now()->today())->count()),
            'Deze maand' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('hired_at', '>=', now()->subMonth()))
                ->badge(Employee::query()->where('hired_at', '>=', now()->subMonth())->count()),
            'Dit jaar' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('hired_at', '>=', now()->subYear()))
                ->badge(Employee::query()->where('hired_at', '>=', now()->subYear())->count()),
        ];

            return $tabs;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PanelEmployeeOverviewMessage::class,
        ];
    }
}
