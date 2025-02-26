<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Filament\Infolists\VideoEntry;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;

class ViewMedia extends ViewRecord
{
    protected static string $resource = MediaResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        $schema = [
            // ...
            Split::make(
                [
                    Section::make()->schema(
                        [
                            ImageEntry::make('url')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
                                ->visible(fn ($record): bool => $record->type === 'image'),

                            VideoEntry::make('url')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
                                ->visible(fn ($record): bool => $record->type === 'video'),
                        ]
                    ),
                    Section::make()->schema(
                        [
                            Actions::make([
                                Action::make('convert')
                                    ->label('')
                                    ->tooltip('convert')
                                    ->icon('heroicon-o-scale')
                                    // ->requiresConfirmation()
                                    ->form(MediaConvertResource::getFormSchema())
                                    ->action(function ($record, array $data): void {
                                        $data['disk'] = $record->disk;
                                        $data['file'] = $record->id.'/'.$record->file_name;
                                        $convert_data = ConvertData::from($data);
                                        // app(ConvertVideoByConvertDataAction::class)->execute($convert_data);
                                        // MediaConvert::create($convert_data->toArray());
                                        $record->mediaConverts()->create($convert_data->toArray());
                                    }),
                            ]),
                            TextEntry::make('name'),
                            TextEntry::make('collection_name'),
                            TextEntry::make('mime_type'),
                            TextEntry::make('human_readable_size'),
                            TextEntry::make('created_at'),
                        ]
                    ),
                ]
            ),
        ];

        // $schema = [];

        $schema[] = RepeatableEntry::make('entry_conversions')
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('src'),
                ImageEntry::make('src'),
                // TextEntry::make('title'),
                // TextEntry::make('content')
                //    ->columnSpan(2),
            ])
            ->columns(4);

        return $infolist

            ->schema($schema)
            ->columns(1);
    }

    /**
     * @return DeleteAction[]
     *
     * @psalm-return list{DeleteAction}
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ConvertWidget::make(['record' => $this->record]),
        ];
    }
}
