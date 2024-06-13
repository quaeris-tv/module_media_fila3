<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\CuratorMediaResource\Pages;

use Awcodes\Curator\Resources\MediaResource\ListMedia;
use Filament\Actions;
use Modules\Media\Filament\Resources\CuratorMediaResource;

class ListCuratorMedia extends ListMedia
{
    protected static string $resource = CuratorMediaResource::class;

    public function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            ...parent::getHeaderActions(),
        ];
    }
}
