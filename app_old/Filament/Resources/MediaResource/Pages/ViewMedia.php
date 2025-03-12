<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

<<<<<<< HEAD
use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Filament\Infolists\VideoEntry;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Infolists\Infolist;
use Filament\Actions\DeleteAction;
use Modules\Media\Datas\ConvertData;
use Filament\Infolists\Components\Split;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Modules\Media\Filament\Infolists\VideoEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;
>>>>>>> 012d87af846e72acdf130a0c5a0a482dd4531f20

class ViewMedia extends XotBaseViewRecord
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
<<<<<<< HEAD
                                ->visible(fn ($record): bool => 'image' === $record->type),
=======
                                ->visible(fn ($record): bool => $record->type === 'image'),
>>>>>>> 012d87af846e72acdf130a0c5a0a482dd4531f20

                            VideoEntry::make('url')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
<<<<<<< HEAD
                                ->visible(fn ($record): bool => 'video' === $record->type),
=======
                                ->visible(fn ($record): bool => $record->type === 'video'),
>>>>>>> 012d87af846e72acdf130a0c5a0a482dd4531f20
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
