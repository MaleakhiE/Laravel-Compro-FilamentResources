<?php

namespace App\Filament\Resources\TypeProjectsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TypeProjectsResource;
use App\Filament\Resources\TypeProjectsResource\Widgets\TypeProjectStat;

class ListTypeProjects extends ListRecords
{
    protected static string $resource = TypeProjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TypeProjectStat::class,
        ];
    }
}
