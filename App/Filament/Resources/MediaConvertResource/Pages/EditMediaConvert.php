<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Media\Filament\Resources\MediaConvertResource;

<<<<<<< HEAD
class EditMediaConvert extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
=======
class EditMediaConvert extends EditRecord
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
{
    protected static string $resource = MediaConvertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
