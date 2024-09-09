<?php

namespace App\Filament\Resources\ProjectsShowCaseResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProjectsShowCaseResource;
use App\Filament\Resources\ProjectsShowCaseResource\Widgets\ProjectsShowCaseStats;

class ListProjectsShowCases extends ListRecords
{
    protected static string $resource = ProjectsShowCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectsShowCaseStats::class,
        ];
    }
}
