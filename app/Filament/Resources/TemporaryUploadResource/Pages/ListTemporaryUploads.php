<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\TemporaryUploadResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Media\Filament\Resources\TemporaryUploadResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListTemporaryUploads extends XotBaseListRecords
{
    protected static string $resource = TemporaryUploadResource::class;

    public function getListTableColumns(): array
    {
        return [
            'folder' => TextColumn::make('folder')
                ->searchable()
                ->sortable()
                ->wrap(),
            'filename' => TextColumn::make('filename')
                ->searchable()
                ->sortable()
                ->wrap(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    public function getTableFilters(): array
    {
        return [
<<<<<<< HEAD
            'folder' => \Filament\Tables\Filters\SelectFilter::make('folder')
                ->options(fn () => \Modules\Media\Models\TemporaryUpload::distinct()->pluck('folder', 'folder')->toArray()),
        ];
    }
=======
<<<<<<< HEAD
            'folder'=>\Filament\Tables\Filters\SelectFilter::make('folder')
=======
            \Filament\Tables\Filters\SelectFilter::make('folder')
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
                ->options(fn () => \Modules\Media\Models\TemporaryUpload::distinct()->pluck('folder', 'folder')->toArray()),
        ];
    }

<<<<<<< HEAD
    
=======
    public function getTableActions(): array
    {
        return [
            ViewAction::make(),
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            \Filament\Tables\Actions\DeleteBulkAction::make(),
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
>>>>>>> 5b301225981f0c2116c7e0b5bea444099a08bfd7
>>>>>>> 055718a1 (up)
}
