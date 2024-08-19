<?php
/**
 * @see https://spatie.be/docs/laravel-medialibrary/v11/converting-other-file-types/creating-a-custom-image-generator
 */

declare(strict_types=1);

namespace Modules\Media\Conversions\ImageGenerators;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Conversions\ImageGenerators\ImageGenerator;

class PowerPoint extends ImageGenerator
{
    /**
     * This function should return a path to an image representation of the given file.
     */
    public function convert(string $file, ?Conversion $conversion = null): string
    {
        $pathToImageFile = pathinfo($file, PATHINFO_DIRNAME).'/'.pathinfo($file, PATHINFO_FILENAME).'.jpg';

        // Here you should convert the file to an image and return generated conversion path.
        // EXAMPLE
        // EXAMPLE
        // EXAMPLE
        // \PowerPoint::convertFileToImage($file)->store($pathToImageFile);

        return $pathToImageFile;
    }

    public function requirementsAreInstalled(): bool
    {
        return true;
    }

    public function supportedExtensions(): Collection
    {
        return collect(['ppt', 'pptx']);
    }

    public function supportedMimeTypes(): Collection
    {
        return collect([
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ]);
    }
}
