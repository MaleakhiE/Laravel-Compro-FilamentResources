<?php

namespace App\Filament\Resources\ServicesResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ServicesResource;
use App\Filament\Resources\ServicesResource\Widgets\ServicesStat;

class ListServices extends ListRecords
{
    protected static string $resource = ServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ServicesStat::class,
        ];
    }
}
