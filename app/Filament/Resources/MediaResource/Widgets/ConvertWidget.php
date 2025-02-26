<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Widgets;

use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Models\Media;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertWidget extends Widget
{
    public Media $record;

    public string $time = '';

    public string $start = '';

    public float $percentage = 0;

    /** @var float */
    public $remaining;

    /** @var float */
    public $rate;

    protected static string $view = 'media::filament.widgets.convert';

    protected static string $resource = MediaResource::class;

    public function begin(): void
    {
        $disk_mp4 = $this->record->disk;
        $file_mp4 = $this->record->getPath();

        $disk_path = Storage::disk($disk_mp4)->path('/');
        $file_mp4 = Str::after($file_mp4, $disk_path);

        // dddx($file_mp4);

        $format = new \FFMpeg\Format\Video\WebM;
        $extension = mb_strtolower(class_basename($format));
        $file_new = Str::of($file_mp4)
            ->replaceLast('.mp4', '.'.$extension)
            ->toString();

        /*
         * -preset ultrafast.
         */
        FFMpeg::fromDisk($disk_mp4)
            ->open($file_mp4)
            ->export()
            // ->addFilter(function (VideoFilters $filters) {
            //    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            // })
            // ->resize(640, 480)
            ->onProgress(function (float $percentage, float $remaining, float $rate): void {
                $this->percentage = $percentage;
                $this->remaining = $remaining;
                $this->rate = $rate;
                $msg = "{$percentage}% transcoded";
                $msg .= "{$remaining} seconds left at rate: {$rate}";
                Notification::make()
                    ->title($msg)
                    ->success()
                    ->send();
            })
            ->toDisk($disk_mp4)
            ->inFormat($format)
            ->save($file_new);

        while ($this->percentage < 100) {
            // Stream the current count to the browser...
            $this->stream(
                to: 'count',
                content: $this->start,
                replace: true,
            );

            // Pause for 1 second between numbers...
            // sleep(1);

            $this->start = "{$this->percentage}% transcoded".PHP_EOL."{$this->remaining} seconds left at rate: {$this->rate}";

            // Decrement the counter...
            // $this->start = $this->start - 1;
            // $this->start = (string) now();
            // if ('impossible' === $this->start) {
            //    $cond = false;
            // }
        }
    }
}
