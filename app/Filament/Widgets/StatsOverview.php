<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Department;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // New Users in the Last 30 Days
        $newUsersCount = User::where('created_at', '>', now()->subDays(30))->count();
        $previousUserPeriodCount = User::whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])->count();
        $newUsersGrowth = $previousUserPeriodCount > 0 ? (($newUsersCount - $previousUserPeriodCount) / $previousUserPeriodCount) * 100 : 0;

        // New Departments in the Last 30 Days
        $newDepartmentCount = Department::where('created_at', '>', now()->subDays(30))->count();
        $previousDepartmentPeriodCount = Department::whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])->count();
        $newDepartmentsGrowth = $previousDepartmentPeriodCount > 0 ? (($newDepartmentCount - $previousDepartmentPeriodCount) / $previousDepartmentPeriodCount) * 100 : 0;


        return [
            Stat::make('Nieuwe gebruikers', number_format($newUsersCount))
                ->description(number_format($newUsersGrowth, 2) . '%')
                ->descriptionIcon($newUsersGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($newUsersGrowth >= 0 ? 'primary' : 'danger'),

            Stat::make('Nieuwe afdelingen', number_format($newDepartmentCount))
                ->description(number_format($newDepartmentsGrowth, 2) . '%')
                ->descriptionIcon($newDepartmentsGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($newDepartmentsGrowth >= 0 ? 'primary' : 'danger'),

            // TODO
            Stat::make('Gemiddelde tijd op pagina', '3:12')
                ->beschrijving('3% toename')
                ->beschrijvingsicoon('heroicon-m-pijl-omhoog-trending')
                ->kleur('succes'),
        ];
    }
}
