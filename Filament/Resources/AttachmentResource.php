<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Media\Enums\AttachmentTypeEnum;
use Modules\Sam\Filament\Resources\AssetResource\Actions\AttachmentDownloadBulkAction;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Webmozart\Assert\Assert;

class AttachmentResource extends XotBaseResource
{
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form, bool $asset = true): Form
    {
        return $form
            ->schema(
                self::getFormSchema($asset)
            );
    }

    public static function table(Table $table): Table
    {
        Assert::string($date_format = config('app.date_format'), '['.__LINE__.']['.__FILE__.']');

        return $table
            ->columns(
                [
                    TextColumn::make('collection_name')
                        ->label(static::trans('fields.collection_name')),

                    TextColumn::make('name')
                        ->label(static::trans('fields.filename')),

                    TextColumn::make('human_readable_size')
                        ->label(static::trans('fields.size')),

                    TextColumn::make('creator.full_name')
                        ->label(static::trans('fields.creator.full_name'))
                        // ->default(fn($record)=>dddx($record))
                        ->toggleable(),

                    TextColumn::make('created_at')
                        ->label(static::trans('fields.created_at'))
                        ->dateTime($date_format)
                        ->toggleable(),
                ]
            )
            ->filters(
                [
                ]
            )
            ->actions(
                [
                    ActionGroup::make(
                        [
                            Action::make('view_attachment')
                                ->label(static::trans('actions.view_attachment'))
                                ->icon('heroicon-s-eye')
                                ->color('gray')
                                ->url(
                                    static fn ($record): string => $record->getUrl()
                                )->openUrlInNewTab(true),
                            DeleteAction::make()->requiresConfirmation(),
                            Action::make('download_attachment')
                                ->label(static::trans('actions.download_attachment'))
                                ->icon('heroicon-o-arrow-down-tray')
                                ->color('primary')
                                ->action(
                                    // File extension obtained by substringing
                                    static fn ($record) => response()->download($record->getPath(), $record->name.mb_substr((string) mb_strrchr((string) $record->file_name, '.'), 0))
                                ),
                        ]
                    ),
                ]
            )
            ->bulkActions(
                [
                    DeleteBulkAction::make(),
                    // AttachmentDownloadBulkAction::make(),
                ]
            )
            ->defaultSort(
                column: 'created_at',
                direction: 'DESC',
            );
    }

    /**
     * return (Radio|TextInput|BaseFileUpload|FileUpload)[].
     *
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function getFormSchema(bool $asset = true): array
    {
        Assert::string($disk = $asset ? config('camping.asset.attachments.disk.driver') : config('camping.operation.attachments.disk.driver'));
        Assert::isArray($file_types = $asset ? config('camping.asset.attachments.allowed_file_types') : config('camping.operation.attachments.allowed_file_types'));
        Assert::integer($max_size = config('media-library.max_file_size'));

        return [
            FileUpload::make('file')

                ->label(static::trans('fields.file'))
                ->hint(static::trans('fields.file_hint'))
                ->storeFileNamesIn('original_file_name')
                ->disk($disk)
                ->acceptedFileTypes($file_types)
                ->visibility('private')
                ->maxSize($max_size)
                ->required()
                ->columnSpanFull(),
            /*
            Radio::make('attachment_type')
                ->hiddenLabel()
                ->options(
                    AttachmentTypeEnum::descriptionsByValue($asset ? AttachmentTypeEnum::cases() : AttachmentTypeEnum::operationCases()),
                )
                ->default(AttachmentTypeEnum::Image())
                ->columns(
                    $asset ? \count(AttachmentTypeEnum::cases()) : \count(AttachmentTypeEnum::operationCases()),
                )
                ->required()
                ->columnSpanFull(),
            */
            // Radio::make('attachment_type')->columnSpanFull(),
            TextInput::make('name')
                ->translateLabel()
                ->label(static::trans('fields.name'))
                ->hint(static::trans('fields.name_hint'))
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }
}
