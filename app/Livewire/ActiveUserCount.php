<?php

namespace App\Livewire;

use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class ActiveUserCount extends ChartWidget
{
    protected static ?string $heading = 'Geregistreerde gebruikers';

    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '300px';
 
    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Geregistreerde gebruikers',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
 
    protected function getType(): string
    {
        return 'line';
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];
}
