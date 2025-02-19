<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
<<<<<<< HEAD
use Filament\Tables\Filters\SelectFilter;
=======
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMedia extends XotBaseListRecords
{
    protected static string $resource = MediaResource::class;

<<<<<<< HEAD
=======
<<<<<<< HEAD
   

>>>>>>> 055718a1 (up)
    /**
     * @return array<string, Tables\Columns\Column>
=======
    public function getGridTableColumns(): array
    {
        Assert::string($date_format = config('app.date_format'));

        return [
            Stack::make([
                TextColumn::make('collection_name'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->sortable(),
                ImageColumn::make('preview')
                    ->size(60)
                    ->defaultImageUrl(fn ($record) => $record->getUrlConv('thumb')),
                TextColumn::make('human_readable_size'),
                TextColumn::make('creator.name')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime($date_format)
                    ->toggleable(),
            ]),
        ];
    }

    /**
     * @return array<string, \Filament\Tables\Columns\Column>
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
     */
    public function getListTableColumns(): array
    {
        return [
<<<<<<< HEAD
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'name' => TextColumn::make('name')
                ->sortable()
                ->searchable(),
            'size' => TextColumn::make('size')
                ->formatStateUsing(fn (string $state): string => number_format((int) $state / 1024, 2).' KB'),
            'mime_type' => TextColumn::make('mime_type')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * @return array<string, Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            'type' => SelectFilter::make('mime_type')
                ->options([
                    'image/jpeg' => 'JPEG',
                    'image/png' => 'PNG',
                    'application/pdf' => 'PDF',
                ]),
        ];
    }

    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'download' => Action::make('download')
                ->url(fn ($record) => route('media.download', $record))
                ->openUrlInNewTab(),
            'delete' => DeleteAction::make(),
            'preview' => Action::make('preview')
                ->url(fn ($record) => route('media.preview', $record))
                ->openUrlInNewTab(),
            'stream' => Action::make('stream')
                ->url(fn ($record) => route('media.stream', $record))
                ->openUrlInNewTab(),
=======
            'id' => TextColumn::make('id'),
            'model_type' => TextColumn::make('model_type')
                ->searchable(),
            'model_id' => TextColumn::make('model_id')
                ->searchable(),
            'collection_name' => TextColumn::make('collection_name')
                ->searchable(),
            'name' => TextColumn::make('name')
                ->searchable(),
            'file_name' => TextColumn::make('file_name')
                ->searchable(),
            'mime_type' => TextColumn::make('mime_type')
                ->searchable(),
            'disk' => TextColumn::make('disk')
                ->searchable(),
            'size' => TextColumn::make('size')
                ->formatStateUsing(fn (string $state): string => number_format($state / 1024, 2).' KB'),
            'created_at' => TextColumn::make('created_at')
                ->dateTime(),
        ];
    }

    public function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('collection_name')
                ->options(fn () => Media::distinct()->pluck('collection_name', 'collection_name')->toArray()),
            Tables\Filters\SelectFilter::make('mime_type')
                ->options(fn () => Media::distinct()->pluck('mime_type', 'mime_type')->toArray()),
        ];
    }

    public function getTableActions(): array
    {
        return [
            ViewAction::make()
                ->label(''),
            Action::make('view_attachment')
                ->label('')
                ->icon('heroicon-s-eye')
                ->color('gray')
                ->url(
                    static fn (Media $record): string => $record->getUrl()
                )->openUrlInNewTab(true),
            DeleteAction::make()
                ->label('')
                ->requiresConfirmation(),
            Action::make('download_attachment')
                ->label('')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->action(
                    static fn ($record) => response()->download($record->getPath(), $record->file_name)
                ),
            Action::make('convert')
                ->label('')
                ->icon('convert01')
                ->color('gray')
                ->url(
                    function ($record): string {
                        Assert::string($res = static::$resource::getUrl('convert', ['record' => $record]));

                        return $res;
                    }
                )->openUrlInNewTab(true),
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
        ];
    }
}
