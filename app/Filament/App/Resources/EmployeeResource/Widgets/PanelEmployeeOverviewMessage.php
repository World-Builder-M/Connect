<?php

namespace App\Filament\App\Resources\EmployeeResource\Widgets;

use Filament\Widgets\Widget;

class PanelEmployeeOverviewMessage extends Widget
{
    protected int | string | array $columnSpan = 2;
    
    protected static string $view = 'filament.app.resources.employee-resource.widgets.panel-employee-overview-message';
}
