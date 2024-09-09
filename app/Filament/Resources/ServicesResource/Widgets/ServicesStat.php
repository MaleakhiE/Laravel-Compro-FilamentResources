<?php

namespace App\Filament\Resources\ServicesResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServicesStat extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Services', \App\Models\Services::all()->count()),
            Stat::make('Total Active Services', \App\Models\Services::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Services', \App\Models\Services::all()->where('status', 0)->count()),
        ];
    }
}
