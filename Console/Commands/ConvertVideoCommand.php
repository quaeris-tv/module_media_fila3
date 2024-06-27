<?php

declare(strict_types=1);

namespace Modules\Media\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Webmozart\Assert\Assert;

class ConvertVideoCommand extends Command
{
    /** @var string */
    protected $signature = 'media:convert-video {disk} {file}';

    /** @var string */
    protected $description = 'Convert Video';

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        Assert::string($disk = $this->argument('disk'));
        Assert::string($file = $this->argument('file'));
        $this->info('disk: '.print_r($disk, true));
        $this->info('file: '.print_r($file, true));
        // $this->error('');
        // $this->line('Display this on the screen');
        if (! Storage::disk($disk)->exists($file)) {
            $this->error('['.$disk.'] file ['.$file.'] Not Exists');

            return;
        }
        $format = new \FFMpeg\Format\Video\WebM;
        $extension = strtolower(class_basename($format));
        $file_new = Str::of($file)
            ->replaceLast('.mp4', '.'.$extension)
            ->toString();

        /**
         * -preset ultrafast.
         */
        $res = FFMpeg::fromDisk($disk)
            ->open($file)
            ->export()
            // ->addFilter(function (VideoFilters $filters) {
            //    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            // })
            // ->resize(640, 480)
            ->onProgress(function ($percentage, $remaining, $rate) {
                $this->info("{$percentage}% transcoded");
                $this->info("{$remaining} seconds left at rate: {$rate}");
            })
            ->toDisk($disk)
            ->inFormat($format)
            ->save($file_new);

        return Storage::disk($disk)->url($file_new);
    }
}
