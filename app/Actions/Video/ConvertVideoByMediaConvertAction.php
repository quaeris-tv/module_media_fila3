<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions\Video;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Models\MediaConvert;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\MediaOpener;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ConvertVideoByMediaConvertAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(MediaConvert $record): ?string
    {
        $data = ConvertData::from($record);
        $starting_time = microtime(true);
        if (! $data->exists()) {
            return '';
        }
        $format = $data->getFFMpegFormat();
        // $file_new = $data->getConvertedFilename();
        $file_new = $record->converted_file;

        Notification::make()
            ->title('Start')
            ->success()
            ->send();

        /*
         * -preset ultrafast.
         */
        // Ensure we have a proper MediaOpener instance
        $media = FFMpeg::fromDisk($data->disk);
        Assert::isInstanceOf($media, MediaOpener::class, 'FFMpeg::fromDisk() deve restituire un\'istanza di MediaOpener');
        
        $openedMedia = $media->open($data->file);
        Assert::notNull($openedMedia, 'Impossibile aprire il file video');
        
        $exportedMedia = $openedMedia->export();
        Assert::notNull($exportedMedia, 'Impossibile esportare il file video');
        
        // Add progress callback
        $withProgressMedia = $exportedMedia->onProgress(function (float $percentage, float $remaining, float $rate) use ($record): void {
            $msg = "{$percentage}% transcoded";
            $msg .= "{$remaining} seconds left at rate: {$rate}";

            $record->update([
                'percentage' => $percentage,
                'remaining' => $remaining,
                'rate' => $rate,
            ]);

            Notification::make()
                ->title($msg)
                ->success()
                ->send();
        });
        Assert::notNull($withProgressMedia, 'Impossibile aggiungere il callback di progresso');
        
        // Add filters
        $withFiltersMedia = $withProgressMedia->addFilter('-preset', 'ultrafast');
        Assert::notNull($withFiltersMedia, 'Impossibile aggiungere i filtri');
        
        // Set target disk
        /** @phpstan-ignore-next-line */
        $toDiskMedia = $withFiltersMedia->toDisk($data->disk);
        Assert::notNull($toDiskMedia, 'Impossibile specificare il disco di destinazione');
        
        // Set format
        /** @phpstan-ignore-next-line */
        $formattedMedia = $toDiskMedia->inFormat($format);
        Assert::notNull($formattedMedia, 'Impossibile applicare il formato al video');
        
        // Save
        /** @phpstan-ignore-next-line */
        $formattedMedia->save($file_new);

        $finished_time = microtime(true);

        $record->update([
            'execution_time' => $finished_time - $starting_time,
        ]);

        return Storage::disk($data->disk)->url((string) $file_new);
    }
}
