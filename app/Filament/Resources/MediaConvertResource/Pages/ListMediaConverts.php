<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Job\Filament\Widgets\ClockWidget;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Models\MediaConvert;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMediaConverts extends XotBaseListRecords
{
    protected static string $resource = MediaConvertResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable(),
            'media.file_name' => TextColumn::make('media.file_name')
                ->sortable(),
            'format' => TextColumn::make('format')
                ->searchable(),
            'codec_video' => TextColumn::make('codec_video')
                ->searchable(),
            'codec_audio' => TextColumn::make('codec_audio')
                ->searchable(),
            'preset' => TextColumn::make('preset')
                ->searchable(),
            'bitrate' => TextColumn::make('bitrate'),
            'width' => TextColumn::make('width')
                ->numeric(),
            'height' => TextColumn::make('height')
                ->numeric(),
            'threads' => TextColumn::make('threads')
                ->numeric(),
            'speed' => TextColumn::make('speed')
                ->numeric(),
            'percentage' => TextColumn::make('percentage')
                ->numeric(),
            'remaining' => TextColumn::make('remaining')
                ->numeric(),
            'rate' => TextColumn::make('rate')
                ->numeric(),
            'execution_time' => TextColumn::make('execution_time')
                ->numeric(),
        ];
    }

    /**
     * @return array<string, Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            'format' => SelectFilter::make('format')
                ->options(fn () => MediaConvert::distinct()->pluck('format', 'format')->toArray()),
            'codec_video' => SelectFilter::make('codec_video')
                ->options(fn () => MediaConvert::distinct()->pluck('codec_video', 'codec_video')->toArray()),
            'codec_audio' => SelectFilter::make('codec_audio')
                ->options(fn () => MediaConvert::distinct()->pluck('codec_audio', 'codec_audio')->toArray()),
        ];
    }

    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'convert' => Action::make('convert')
                ->action(function (MediaConvert $record): void {
                    $record->update(['percentage' => 0]);
                    app(ConvertVideoByMediaConvertAction::class)
                        ->onQueue()
                        ->execute($record);
                }),
        ];
    }

    /**
     * @return array<string, Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            ClockWidget::class,
        ];
    }
}
