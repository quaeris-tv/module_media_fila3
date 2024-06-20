<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
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
    }
}
