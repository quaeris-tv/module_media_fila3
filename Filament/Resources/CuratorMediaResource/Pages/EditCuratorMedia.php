<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\CuratorMediaResource\Pages;

use Awcodes\Curator\Resources\MediaResource\EditMedia;
use Filament\Actions;
use Modules\Media\Filament\Resources\CuratorMediaResource;

class EditCuratorMedia extends EditMedia
{
    protected static string $resource = CuratorMediaResource::class;

    public function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            ...parent::getHeaderActions(),
        ];
    }
}
