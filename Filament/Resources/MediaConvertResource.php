<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Modules\Media\Filament\Resources\MediaConvertResource\Pages;
use Modules\Media\Models\MediaConvert;

class MediaConvertResource extends Resource
{
    protected static ?string $model = MediaConvert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaConverts::route('/'),
            'create' => Pages\CreateMediaConvert::route('/create'),
            'edit' => Pages\EditMediaConvert::route('/{record}/edit'),
        ];
    }
}
