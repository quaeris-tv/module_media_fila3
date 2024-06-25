<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaConvert extends BaseModel
{
    protected $fillable = [
        'media_id',
        'format',
        'codec_video',
        'codec_audio',
        'preset',
        'bitrate',
        'width',
        'height',
        'threads',
        'speed',
        'percentage',
        'remaining',
        'rate',
        'execution_time',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function getDiskAttribute(?string $value): ?string
    {
        return $this->media?->disk;
    }

    public function getFileAttribute(?string $value): ?string
    {
        return $this->media?->id.'/'.$this->media?->file_name;
    }

    public function getConvertedFileAttribute(?string $value): ?string
    {
        $info = pathinfo($this->media?->file_name);

        // "dirname" => "."
        // "basename" => "20600550-uhd_3840_2160_30fps.mp4"
        // "extension" => "mp4"
        // "filename" => "20600550-uhd_3840_2160_30fps"

        return $this->media?->id.'/conversions/'.$info['filename'].'_'.$this->id.'.'.$this->format;
    }
}
