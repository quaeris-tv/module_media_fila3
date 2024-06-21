<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Radio;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\Media\Filament\Infolists\VideoEntry;
use Modules\Media\Filament\Resources\MediaResource;

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

    public function infolist(Infolist $infolist): Infolist
    {
        // dddx(get_class_methods(ImageEntry::class));

        $schema = [
            // ...
            Split::make(
                [
                    Section::make()->schema(
                        [
                            ImageEntry::make('src')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
                                ->visible(fn ($record) => 'image' == $record->type),

                            VideoEntry::make('src')
                                ->label('')
                                ->defaultImageUrl(fn ($record) => $record->getUrl())
                                ->size(500)
                                ->visible(fn ($record) => 'video' == $record->type),
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
                                                'webm01' => 'webm01',
                                                'webm02' => 'webm02',
                                            ])
                                            ->inline()
                                            ->inlineLabel(false),
                                    ])
                                    ->action(function ($record, $data) {
                                        dddx([$record, $data]);
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

        dddx($this->record);

        return $infolist
            ->schema($schema)
            ->columns(1);
    }
}
