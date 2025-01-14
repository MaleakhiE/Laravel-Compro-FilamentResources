<?php

namespace App\Filament\Resources\ClientsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ClientsResource;
use App\Filament\Resources\ClientsResource\Widgets\ClientStats;

class ListClients extends ListRecords
{
    protected static string $resource = ClientsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ClientStats::class,
        ];
    }
}
