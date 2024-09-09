<?php

namespace App\Filament\Resources\TypeProjectsResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TypeProjectStat extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Types', \App\Models\TypeProjects::all()->count()),
            Stat::make('Total Active Types', \App\Models\TypeProjects::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Types', \App\Models\TypeProjects::all()->where('status', 0)->count()),
        ];
    }
}
