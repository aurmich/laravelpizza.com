<?php

declare(strict_types=1);

namespace Modules\Media\Conversions\VideoGenerators;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Conversions\ImageGenerators\ImageGenerator;

class Webm extends ImageGenerator
{
<<<<<<< HEAD
    public function convert(string $file, null|Conversion $conversion = null): string
    {
        $pathToImageFile = pathinfo($file, PATHINFO_DIRNAME) . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webmXXX';
=======
    public function convert(string $file, ?Conversion $conversion = null): string
    {
        $pathToImageFile = pathinfo($file, PATHINFO_DIRNAME).'/'.pathinfo($file, PATHINFO_FILENAME).'.webmXXX';
>>>>>>> 0a466ed (.)
        dddx([
            'file' => $file,
            '$pathToImageFile' => ${$pathToImageFile},
            'conversion' => $conversion,
        ]);

        /*
<<<<<<< HEAD
         * $image = imagecreatefromwebp($file);
         *
         * imagepng($image, $pathToImageFile, 9);
         *
         * imagedestroy($image);
         */
=======
        $image = imagecreatefromwebp($file);

        imagepng($image, $pathToImageFile, 9);

        imagedestroy($image);
        */
>>>>>>> 0a466ed (.)
        return $pathToImageFile;
    }

    public function requirementsAreInstalled(): bool
    {
        /*
<<<<<<< HEAD
         * if (! function_exists('imagecreatefromwebp')) {
         * return false;
         * }
         *
         * if (! function_exists('imagepng')) {
         * return false;
         * }
         *
         * if (! function_exists('imagedestroy')) {
         * return false;
         * }
         */
=======
        if (! function_exists('imagecreatefromwebp')) {
            return false;
        }

        if (! function_exists('imagepng')) {
            return false;
        }

        if (! function_exists('imagedestroy')) {
            return false;
        }
        */
>>>>>>> 0a466ed (.)
        return true;
    }

    public function supportedExtensions(): Collection
    {
        return collect([
            // 'webm',
            // 'mov',
            'mp4',
        ]);
    }

    public function supportedMimeTypes(): Collection
    {
        return collect([
            // 'video/webm',
            'video/mpeg',
            'video/mp4',
            // 'video/quicktime'
        ]);
    }
}
