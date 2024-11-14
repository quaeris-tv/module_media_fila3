<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

use Filament\Tables;
use Filament\Actions;
use Filament\Tables\Table;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\Media\Models\MediaConvert;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Enums\ActionsPosition;
use Modules\Job\Filament\Widgets\ClockWidget;
use Modules\Xot\Filament\Pages\XotBaseListRecords;
use Modules\Job\Filament\Widgets\QueueListenWidget;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;

class ListMediaConverts extends XotBaseListRecords
{
    
    protected static string $resource = MediaConvertResource::class;

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('media.file_name'),
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

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions())
            ->actionsPosition(ActionsPosition::BeforeColumns);
    }

    protected function getTableHeaderActions(): array
    {
        return [
            TableLayoutToggleTableAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // QueueListenWidget::make(),
            ClockWidget::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
