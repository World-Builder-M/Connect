<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use Filament\Widgets\Widget;

class EmployeeOverview extends Widget
{
    protected static string $view = 'filament.resources.employee-resource.widgets.employee-overview';

    protected int | string | array $columnSpan = 2;
}
