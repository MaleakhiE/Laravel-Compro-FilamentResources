<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Clients;
use App\Models\Projects;
use App\Models\ProjectsShowCases;
use App\Models\Banners;


class DashboardChart extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Clients', Clients::all()->count())
                ->icon('heroicon-o-user')
                ->url('/admin/clients'),
            Stat::make('Total Projects', Projects::all()->count())
                ->icon('heroicon-o-archive-box')
                ->url('/admin/projects'),
            Stat::make('Total Project Showcases', ProjectsShowCases::all()->count())
                ->icon('heroicon-o-archive-box')
                ->url('/admin/projects-show-case'),
            Stat::make('Total Banners', Banners::all()->count())
                ->icon('heroicon-o-photo')
                ->url('/admin/banners'),
        ];
    }
}
