<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Media\Filament\Resources\MediaResource;

<<<<<<< HEAD
class EditMedia extends \Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord
=======
class EditMedia extends EditRecord
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
{
    protected static string $resource = MediaResource::class;

    /**
     * @return DeleteAction[]
     *
     * @psalm-return list{DeleteAction}
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
