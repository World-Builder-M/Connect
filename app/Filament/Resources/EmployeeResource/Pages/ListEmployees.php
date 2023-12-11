<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use App\Models\Employee;
use Illuminate\Support\Str;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources\EmployeeResource\Widgets\EmployeeOverview;

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
            //  EmployeeOverview::class,
        ];
    }
}
