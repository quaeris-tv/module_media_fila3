<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Tables;
<<<<<<< HEAD
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
=======
use Filament\Tables\Columns\TextColumn;
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
use Modules\Job\Filament\Widgets\ClockWidget;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Models\MediaConvert;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMediaConverts extends XotBaseListRecords
{
    protected static string $resource = MediaConvertResource::class;

<<<<<<< HEAD
    /**
     * @return array<string, Tables\Columns\Column>
     */
=======
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
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

<<<<<<< HEAD
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
=======
    public function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('format')
                ->options(fn () => MediaConvert::distinct()->pluck('format', 'format')->toArray()),
            Tables\Filters\SelectFilter::make('codec_video')
                ->options(fn () => MediaConvert::distinct()->pluck('codec_video', 'codec_video')->toArray()),
            Tables\Filters\SelectFilter::make('codec_audio')
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
                ->options(fn () => MediaConvert::distinct()->pluck('codec_audio', 'codec_audio')->toArray()),
        ];
    }

<<<<<<< HEAD
    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'convert' => Action::make('convert')
=======
    public function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('convert')
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
                ->action(function (MediaConvert $record): void {
                    $record->update(['percentage' => 0]);
                    app(ConvertVideoByMediaConvertAction::class)
                        ->onQueue()
                        ->execute($record);
                }),
        ];
    }

<<<<<<< HEAD
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
=======
    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ClockWidget::make(),
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
        ];
    }
}
