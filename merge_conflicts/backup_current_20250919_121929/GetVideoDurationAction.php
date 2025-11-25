<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Media\Actions\Video;

use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class GetVideoDurationAction
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(string $disk, string $file): null|int
    {
        if (!Storage::disk($disk)->exists($file)) {
            return null;
        } // returns an int

        return FFMpeg::fromDisk($disk)->open($file)->getDurationInSeconds();
=======
    public function execute(string $disk, string $file): ?int
    {
        if (! Storage::disk($disk)->exists($file)) {
            return null;
        } // returns an int

        return FFMpeg::fromDisk($disk)
            ->open($file)
            ->getDurationInSeconds();
>>>>>>> 0a466ed (.)
    }
}
