<?php

namespace App\Filament\Resources\SystemInformationResource\Pages;

use App\Filament\Resources\SystemInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSystemInformation extends ListRecords
{
    protected static string $resource = SystemInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
