<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Media\Filament\Resources\MediaConvertResource;
<<<<<<< HEAD

class CreateMediaConvert extends CreateRecord
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateMediaConvert extends XotBaseCreateRecord
>>>>>>> 012d87af846e72acdf130a0c5a0a482dd4531f20
{
    protected static string $resource = MediaConvertResource::class;
}
