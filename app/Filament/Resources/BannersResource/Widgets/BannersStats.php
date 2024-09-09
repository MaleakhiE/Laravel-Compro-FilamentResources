<?php

namespace App\Filament\Resources\BannersResource\Widgets;

use App\Models\Banners;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BannersStats extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Banners', Banners::all()->count()),
            Stat::make('Total Active Banners', Banners::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Banners', Banners::all()->where('status', 0)->count()),
        ];
    }
}
