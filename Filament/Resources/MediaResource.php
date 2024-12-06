<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Modules\Media\Filament\Resources\MediaResource\Pages;
use Modules\Media\Models\Media;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Webmozart\Assert\Assert;

class MediaResource extends XotBaseResource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'fas-photo-film';

    public static function form(Form $form, bool $asset = true): Form
    {
        return $form
            ->schema(
                static::getFormSchema($asset)
            );
    }

    /**
     * @return (Radio|TextInput|BaseFileUpload|FileUpload)[]
     *
     * @psalm-return list{BaseFileUpload&FileUpload, Radio, TextInput}
     */
    public static function getFormSchema(bool $asset = true): array
    {
        /*
        Assert::string($disk = $asset ? config('camping.asset.attachments.disk.driver') : config('camping.operation.attachments.disk.driver'));
        Assert::isArray($file_types = $asset ? config('camping.asset.attachments.allowed_file_types') : config('camping.operation.attachments.allowed_file_types'));
        Assert::integer($max_size = config('media-library.max_file_size'));
        */
        return [
            FileUpload::make('file')

                ->hint(static::trans('fields.file_hint'))
                ->storeFileNamesIn('original_file_name')
                /*
                ->disk($disk)
                ->acceptedFileTypes($file_types)
                ->maxSize($max_size)
                */
                ->visibility('private')
                ->required()
                ->columnSpanFull(),
            /*-- usiamo enum con il casts sul modello
            Radio::make('attachment_type')
                ->hiddenLabel()
                ->options(
                    AttachmentType::descriptionsByValue($asset ? AttachmentType::cases() : AttachmentType::operationCases()),
                )
                ->default(AttachmentType::Image())
                ->columns(
                    $asset ? count(AttachmentType::cases()) : count(AttachmentType::operationCases()),
                )
                ->required()
                ->columnSpanFull(),
            */
            Radio::make('attachment_type'),
            TextInput::make('name')
                ->translateLabel()

                ->hint(static::trans('fields.name.hint'))
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }

    /**
     * @psalm-return array<never, never>
     */
    public static function getRelations(): array
    {
        return [
        ];
    }

    /**
     * @return PageRegistration[]
     *
     * @psalm-return array{index: PageRegistration, create: PageRegistration, edit: PageRegistration}
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
            'view' => Pages\ViewMedia::route('/{record}'),
            'convert' => Pages\ConvertMedia::route('/{record}/convert'),
        ];
    }
}
