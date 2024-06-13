<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\CuratorMediaResource\Pages;

use Awcodes\Curator\Resources\MediaResource\CreateMedia;
use Modules\Media\Filament\Resources\CuratorMediaResource;

class CreateCuratorMedia extends CreateMedia
{
    protected static string $resource = CuratorMediaResource::class;
}
