<?php

namespace App\Filament\Resources\ClientsResource\Widgets;

use App\Models\Clients;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ClientStats extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Clients', Clients::all()->count()),
            Stat::make('Total Active Clients', Clients::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Clients', Clients::all()->where('status', 0)->count()),
        ];
    }
}
