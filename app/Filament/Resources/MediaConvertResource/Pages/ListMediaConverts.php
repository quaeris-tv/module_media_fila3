<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Modules\Job\Filament\Widgets\ClockWidget;
use Modules\Job\Filament\Widgets\QueueListenWidget;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Models\MediaConvert;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMediaConverts extends XotBaseListRecords
{
    protected static string $resource = MediaConvertResource::class;

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('media.file_name')
                ->sortable(),
            TextColumn::make('format'),
            TextColumn::make('codec_video'),
            TextColumn::make('codec_audio'),
            TextColumn::make('preset'),
            TextColumn::make('bitrate'),
            TextColumn::make('width'),
            TextColumn::make('height'),
            TextColumn::make('threads'),
            TextColumn::make('speed'),
            TextColumn::make('percentage'),
            TextColumn::make('remaining'),
            TextColumn::make('rate'),
            TextColumn::make('execution_time'),
        ];
    }

    public function getListTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->sortable(),
            TextColumn::make('media.file_name')
                ->sortable(),
            TextColumn::make('format')
                ->searchable(),
            TextColumn::make('codec_video')
                ->searchable(),
            TextColumn::make('codec_audio')
                ->searchable(),
            TextColumn::make('preset')
                ->searchable(),
            TextColumn::make('bitrate'),
            TextColumn::make('width')
                ->numeric(),
            TextColumn::make('height')
                ->numeric(),
            TextColumn::make('threads')
                ->numeric(),
            TextColumn::make('speed')
                ->numeric(),
            TextColumn::make('percentage')
                ->numeric(),
            TextColumn::make('remaining')
                ->numeric(),
            TextColumn::make('rate')
                ->numeric(),
            TextColumn::make('execution_time')
                ->numeric(),
        ];
    }

    public function getTableFilters(): array
    {
        return [];
    }

    public function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('convert')
                ->action(function (MediaConvert $record): void {
                    $record->update(['percentage' => 0]);
                    app(ConvertVideoByMediaConvertAction::class)
                        ->onQueue()
                        ->execute($record);
                }),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            // Tables\Actions\BulkActionGroup::make([
            Tables\Actions\DeleteBulkAction::make(),
            // ]);
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // QueueListenWidget::make(),
            ClockWidget::make(),
        ];
    }
}
