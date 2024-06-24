<?php

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Modules\Media\Filament\Resources\MediaConvertResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaConverts extends ListRecords
{
    protected static string $resource = MediaConvertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
