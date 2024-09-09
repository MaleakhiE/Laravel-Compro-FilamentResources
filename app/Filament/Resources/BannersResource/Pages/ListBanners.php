<?php

namespace App\Filament\Resources\BannersResource\Pages;

use Filament\Actions;
use App\Filament\Widgets\BannersChart;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BannersResource;
use App\Filament\Resources\BannersResource\Widgets\BannersStats;

class ListBanners extends ListRecords
{
    protected static string $resource = BannersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BannersStats::class,
        ];
    }
}
