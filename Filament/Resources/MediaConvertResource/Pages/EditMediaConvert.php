<?php

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Modules\Media\Filament\Resources\MediaConvertResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaConvert extends EditRecord
{
    protected static string $resource = MediaConvertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
