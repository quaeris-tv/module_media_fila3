<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;
use Webmozart\Assert\Assert;

class ListMedia extends ListRecords
{
    use NavigationPageLabelTrait;

    protected static string $resource = MediaResource::class;

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
                ->label(static::trans('fields.filename')),

            TextColumn::make('human_readable_size')
                ->label(static::trans('fields.human_readable_size')),

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
            Action::make('view_attachment')
                ->label('')
                ->icon('heroicon-s-eye')
                ->color('gray')
                ->url(
                    static fn ($record): string => $record->getUrl()
                )->openUrlInNewTab(true),
            DeleteAction::make()->label('')->requiresConfirmation(),
            Action::make('download_attachment')
                ->label('')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->action(
                    static fn ($record) => response()->download($record->getPath(), $record->file_name)
                ),
            // ]),
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
            ->defaultSort(
                column: 'created_at',
                direction: 'DESC',
            );
    }
}
