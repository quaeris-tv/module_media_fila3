<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Exception;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Modules\Media\Filament\Actions\Table\ConvertAction;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Models\Media;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

class ListMedia extends XotBaseListRecords
{
    protected static string $resource = MediaResource::class;

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
                    ->defaultImageUrl(fn ($record) =>
                        /*
                    $url = $record->getUrl();
                    $info = pathinfo($url);
                    if(!isset($info['dirname'])) {

                        throw new Exception('['.__LINE__.']['.class_basename($this).']');
                    }
                    $thumb = $info['dirname'].'/conversions/'.$info['filename'].'-thumb.jpg';

                    return url($thumb);
                    */
                        $record->getUrlConv('thumb')),

                TextColumn::make('human_readable_size')
                // ->sortable()
                ,

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
     */
    public function getListTableColumns(): array
    {
        return [
            'id' => Tables\Columns\TextColumn::make('id'),
            'model_type' => Tables\Columns\TextColumn::make('model_type')
                ->searchable(),
            'model_id' => Tables\Columns\TextColumn::make('model_id')
                ->searchable(),
            'collection_name' => Tables\Columns\TextColumn::make('collection_name')
                ->searchable(),
            'name' => Tables\Columns\TextColumn::make('name')
                ->searchable(),
            'file_name' => Tables\Columns\TextColumn::make('file_name')
                ->searchable(),
            'mime_type' => Tables\Columns\TextColumn::make('mime_type')
                ->searchable(),
            'disk' => Tables\Columns\TextColumn::make('disk')
                ->searchable(),
            'size' => Tables\Columns\TextColumn::make('size')
                ->formatStateUsing(fn (string $state): string => number_format($state / 1024, 2).' KB'),
            'created_at' => Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
        ];
    }

    public function getTableFilters(): array
    {
        return [
        ];
    }

    public function getTableActions(): array
    {
        return [
            // ActionGroup::make([
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
            // ]),
            // ConvertAction::make('convert'),
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
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make(),
            // AttachmentDownloadBulkAction::make(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            TableLayoutToggleTableAction::make(),
        ];
    }

    /**
     * @return CreateAction[]
     *
     * @psalm-return list{CreateAction}
     */
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
