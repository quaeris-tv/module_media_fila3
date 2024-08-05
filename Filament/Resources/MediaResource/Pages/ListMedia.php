<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Exception;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Modules\Media\Filament\Actions\Table\ConvertAction;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;
use Webmozart\Assert\Assert;

class ListMedia extends ListRecords
{
    use NavigationPageLabelTrait;

    protected static string $resource = MediaResource::class;

    public TableLayoutEnum $layoutView = TableLayoutEnum::GRID;

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

    public function getTableColumns(): array
    {
        Assert::string($date_format = config('app.date_format'));

        return [
            TextColumn::make('collection_name')
                ->label(static::trans('fields.collection_name')),

            TextColumn::make('name')
                ->label(static::trans('fields.filename'))
                ->searchable()
                ->sortable(),

            TextColumn::make('mime_type')
                ->label(static::trans('fields.mime_type'))
                ->sortable(),

            ImageColumn::make('preview')
                ->label('preview')
                ->size(60)
                ->defaultImageUrl(function ($record) {
                    /*
                    $url = $record->getUrl();
                    $info = pathinfo($url);
                    if(!isset($info['dirname'])) {

                        throw new Exception('['.__LINE__.']['.__FILE__.']');
                    }
                    $thumb = $info['dirname'].'/conversions/'.$info['filename'].'-thumb.jpg';

                    return url($thumb);
                    */
                    return $record->getUrlConv('thumb');
                }),

            TextColumn::make('human_readable_size')
                ->label(static::trans('fields.human_readable_size'))
            // ->sortable()
            ,

            TextColumn::make('creator.name')
                ->label(static::trans('fields.creator.name'))
                ->toggleable(),

            TextColumn::make('created_at')
                ->label(static::trans('fields.uploaded_at'))
                ->dateTime($date_format)
                ->toggleable(),
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
                    static fn ($record): string => $record->getUrl()
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
                    static fn ($record): string => static::$resource::getUrl('convert', ['record' => $record])
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

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions())
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->defaultSort(
                column: 'created_at',
                direction: 'DESC',
            );
    }
}
