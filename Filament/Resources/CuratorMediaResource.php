<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Awcodes\Curator\Resources\MediaResource;
use Modules\Media\Filament\Resources\CuratorMediaResource\Pages;
use Modules\Media\Models\CuratorMedia;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;

class CuratorMediaResource extends MediaResource
{
    use NavigationLabelTrait;
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $model = CuratorMedia::class;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCuratorMedia::route('/'),
            'create' => Pages\CreateCuratorMedia::route('/create'),
            'edit' => Pages\EditCuratorMedia::route('/{record}/edit'),
        ];
    }
}
