<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\TemporaryUploadResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Media\Filament\Resources\TemporaryUploadResource;
<<<<<<< HEAD

class CreateTemporaryUpload extends CreateRecord
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateTemporaryUpload extends XotBaseCreateRecord
>>>>>>> 012d87af846e72acdf130a0c5a0a482dd4531f20
{
    protected static string $resource = TemporaryUploadResource::class;
}
