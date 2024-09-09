<?php

namespace App\Filament\Resources\ProjectsResource\Widgets;

use App\Models\Projects;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProjectsStats extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Projects', Projects::all()->count()),
            Stat::make('Total Active Projects', Projects::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Projects', Projects::all()->where('status', 0)->count()),
        ];
    }
}
