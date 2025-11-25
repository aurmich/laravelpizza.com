<?php

declare(strict_types=1);

namespace Modules\Media\Support;

use Modules\Media\Models\Media;
use Webmozart\Assert\Assert;

// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
// use Modules\Media\Contracts\PathGenerator;
// implements PathGenerator
class TemporaryUploadPathGenerator
{
    /**
     * @param Media $media
     */
    public function getPath($media): string
    {
<<<<<<< HEAD
        return $this->getBasePath($media) . '/' . md5($media->id . $media->uuid . 'original') . '/';
=======
        return $this->getBasePath($media).'/'.md5($media->id . $media->uuid . 'original').'/';
>>>>>>> 0a466ed (.)
    }

    /**
     * @param Media $media
     */
    public function getPathForConversions($media): string
    {
<<<<<<< HEAD
        return $this->getBasePath($media) . '/' . md5($media->id . $media->uuid . 'conversion');
=======
        return $this->getBasePath($media).'/'.md5($media->id . $media->uuid . 'conversion');
>>>>>>> 0a466ed (.)
    }

    /**
     * @param Media $media
     */
    public function getPathForResponsiveImages($media): string
    {
<<<<<<< HEAD
        return $this->getBasePath($media) . '/' . md5($media->id . $media->uuid . 'responsive');
=======
        return $this->getBasePath($media).'/'.md5($media->id . $media->uuid . 'responsive');
>>>>>>> 0a466ed (.)
    }

    /**
     * Get a unique base path for the given media.
     *
     * @param Media $media
     */
    protected function getBasePath($media): string
    {
        Assert::string($id = $media->getKey());
        $key = md5($media->uuid . $id);

        return "tmp/{$key}";
    }
}
