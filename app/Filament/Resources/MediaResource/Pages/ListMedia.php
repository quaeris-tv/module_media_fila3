<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Models\Media;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

class ListMedia extends XotBaseListRecords
{
    protected static string $resource = MediaResource::class;

   

    /**
     * @return array<string, Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'name' => TextColumn::make('name')
                ->sortable()
                ->searchable(),
            'size' => TextColumn::make('size')
                ->formatStateUsing(fn (string $state): string => number_format((int)$state / 1024, 2) . ' KB'),
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
        ];
    }
}
