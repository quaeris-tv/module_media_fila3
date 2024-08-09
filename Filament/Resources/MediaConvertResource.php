<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Modules\Media\Filament\Resources\MediaConvertResource\Pages;
use Modules\Media\Models\MediaConvert;

class MediaConvertResource extends Resource
{
    protected static ?string $model = MediaConvert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getFormSchema(): array
    {
        return [
            Radio::make('format')
            ->label('Format?')
            ->options([
                'webm' => 'webm',
                // 'webm02' => 'webm02',
            ])
            ->inline()
            ->inlineLabel(false),
            // -----------------------------------
            Radio::make('codec_video')
                // ->label('Format?')
                ->options([
                    'libvpx-vp9' => 'libvpx-vp9',
                    'libvpx-vp8' => 'libvpx-vp8',
                ])
                ->inline()
                ->inlineLabel(false),
            Radio::make('codec_audio')
                // ->label('Format?')
                ->options([
                    'copy' => 'copy',
                    'libvorbis' => 'libvorbis',
                ])
                ->inline()
                ->inlineLabel(false),
            Radio::make('preset')
                // ->label('Format?')
                ->options([
                    'fast' => 'fast',
                    'ultrafast' => 'ultrafast',
                ])
                ->inline()
                ->inlineLabel(false),
            TextInput::make('bitrate'),
            TextInput::make('width')->numeric(),
            TextInput::make('height')->numeric(),
            TextInput::make('threads'),
            TextInput::make('speed'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
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
