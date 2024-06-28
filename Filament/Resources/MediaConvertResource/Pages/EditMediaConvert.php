<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Media\Filament\Resources\MediaConvertResource;

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
=======
<?php

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Media\Filament\Resources\MediaConvertResource;

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
>>>>>>> 0bed6b07 (rebase 10)
