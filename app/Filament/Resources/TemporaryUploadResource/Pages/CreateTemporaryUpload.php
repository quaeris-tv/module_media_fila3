<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\TemporaryUploadResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Media\Filament\Resources\TemporaryUploadResource;

class CreateTemporaryUpload extends CreateRecord
{
    protected static string $resource = TemporaryUploadResource::class;
}
