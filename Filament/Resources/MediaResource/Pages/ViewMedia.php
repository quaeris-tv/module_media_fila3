<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\DeleteAction;
<<<<<<< HEAD
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
=======
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
>>>>>>> fd105982 (up)
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Filament\Infolists\VideoEntry;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;

class ViewMedia extends ViewRecord
{
    protected static string $resource = MediaResource::class;

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

<<<<<<< HEAD
    protected function getHeaderWidgets(): array
    {
        return [
            ConvertWidget::make(['record' => $this->record]),
        ];
    }

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
                                ->visible(fn ($record) => $record->type == 'image'),

                            VideoEntry::make('url')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
                                ->visible(fn ($record) => $record->type == 'video'),
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
                                    ->form([
                                        Radio::make('format')
                                            ->label('Format?')
                                            ->options([
                                                'webm' => 'webm',
                                                // 'webm02' => 'webm02',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        // -----------------------------------
                                        Radio::make('codec_video')
                                            // ->label('Format?')
                                            ->options([
                                                'libvpx-vp9' => 'libvpx-vp9',
                                                'libvpx-vp8' => 'libvpx-vp8',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('codec_audio')
                                            // ->label('Format?')
                                            ->options([
                                                'copy' => 'copy',
                                                'libvorbis' => 'libvorbis',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        Radio::make('preset')
                                            // ->label('Format?')
                                            ->options([
                                                'fast' => 'fast',
                                                'ultrafast' => 'ultrafast',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                        TextInput::make('bitrate'),
                                        TextInput::make('width')->numeric(),
                                        TextInput::make('height')->numeric(),
                                        TextInput::make('threads'),
                                        TextInput::make('speed'),
                                    ])
                                    ->action(function ($record, $data) {
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
=======
    public function infolist(Infolist $infolist): Infolist
    {
        // dddx(get_class_methods(ImageEntry::class));

        return $infolist
            ->schema([
                // ...
                Split::make(
                    [
                        Section::make()->schema(
                            [
                                ImageEntry::make('image')
                                    ->label('')
                                    ->defaultImageUrl(fn ($record) => $record->getUrl())
                                    ->size(500),
                            ]
                        ),
                        Section::make()->schema(
                            [
                                Actions::make([
                                    Action::make('star')
                                        ->icon('heroicon-m-star')
                                        ->requiresConfirmation()
                                        ->action(function (Star $star) {
                                            $star();
                                        }),
                                    Action::make('resetStars')
                                        ->icon('heroicon-m-x-mark')
                                        ->color('danger')
                                        ->requiresConfirmation()
                                        ->action(function (ResetStars $resetStars) {
                                            $resetStars();
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
            ])->columns(1);
>>>>>>> fd105982 (up)
    }
}
