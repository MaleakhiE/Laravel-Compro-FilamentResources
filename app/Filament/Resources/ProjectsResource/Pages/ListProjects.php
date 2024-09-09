<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProjectsResource;
use App\Filament\Resources\ProjectsResource\Widgets\ProjectsStats;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectsStats::class,
        ];
    }
}
