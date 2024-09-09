<?php

namespace App\Filament\Resources\ProjectsShowCaseResource\Pages;

use App\Filament\Resources\ProjectsShowCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectsShowCase extends EditRecord
{
    protected static string $resource = ProjectsShowCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
