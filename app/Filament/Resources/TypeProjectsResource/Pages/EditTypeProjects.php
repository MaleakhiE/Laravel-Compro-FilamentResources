<?php

namespace App\Filament\Resources\TypeProjectsResource\Pages;

use App\Filament\Resources\TypeProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeProjects extends EditRecord
{
    protected static string $resource = TypeProjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
