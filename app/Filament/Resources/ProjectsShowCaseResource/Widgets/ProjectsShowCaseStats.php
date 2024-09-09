<?php

namespace App\Filament\Resources\ProjectsShowCaseResource\Widgets;

use App\Models\ProjectsShowCases;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProjectsShowCaseStats extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Showcases', ProjectsShowCases::all()->count()),
            Stat::make('Total Active Showcases', ProjectsShowCases::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Showcases', ProjectsShowCases::all()->where('status', 0)->count()),
        ];
    }
}
