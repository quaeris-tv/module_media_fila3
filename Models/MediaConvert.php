<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Media\Models;

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
}
