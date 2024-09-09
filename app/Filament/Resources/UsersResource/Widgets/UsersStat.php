<?php

namespace App\Filament\Resources\UsersResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersStat extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        return [
            Stat::make('Total Users', \App\Models\User::all()->count()),
            Stat::make('Total Active Users', \App\Models\User::all()->where('status', 1)->count()),
            Stat::make('Total Inactive Users', \App\Models\User::all()->where('status', 0)->count()),
        ];
    }
}
