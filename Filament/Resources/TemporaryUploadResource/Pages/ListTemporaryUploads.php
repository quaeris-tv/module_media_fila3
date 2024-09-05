<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\TemporaryUploadResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Media\Filament\Resources\TemporaryUploadResource;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;

class ListTemporaryUploads extends ListRecords
{
    public TableLayoutEnum $layoutView = TableLayoutEnum::GRID;

    protected static string $resource = TemporaryUploadResource::class;

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
