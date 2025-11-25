<?php

declare(strict_types=1);

namespace Modules\Media\Models;

<<<<<<< HEAD
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
=======
>>>>>>> 0a466ed (.)
use Modules\Media\Database\Factories\TemporaryUploadFactory;
use Closure;
use Exception;
use Illuminate\Support\Carbon;
<<<<<<< HEAD
=======
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
>>>>>>> 0a466ed (.)
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\Media\Exceptions\CouldNotAddUpload;
use Modules\Media\Exceptions\TemporaryUploadDoesNotBelongToCurrentSession;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Webmozart\Assert\Assert;

/**
 * Modules\Media\Models\TemporaryUpload.
 *
 * @property int $id
 * @property string $session_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MediaCollection<int, Media> $media
 * @property int|null $media_count
 * @method static Builder<static>|TemporaryUpload newModelQuery()
 * @method static Builder<static>|TemporaryUpload newQuery()
 * @method static Builder<static>|TemporaryUpload query()
 * @method static Builder<static>|TemporaryUpload whereCreatedAt($value)
 * @method static Builder<static>|TemporaryUpload whereId($value)
 * @method static Builder<static>|TemporaryUpload whereSessionId($value)
 * @method static Builder<static>|TemporaryUpload whereUpdatedAt($value)
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @method static Builder<static>|TemporaryUpload whereCreatedBy($value)
 * @method static Builder<static>|TemporaryUpload whereDeletedAt($value)
 * @method static Builder<static>|TemporaryUpload whereDeletedBy($value)
 * @method static Builder<static>|TemporaryUpload whereUpdatedBy($value)
 * @mixin IdeHelperTemporaryUpload
 * @method static TemporaryUploadFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class TemporaryUpload extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use MassPrunable;

    /**
     * Create a new factory instance for the model.
     *
     * @return TemporaryUploadFactory
     */
    protected static function newFactory(): TemporaryUploadFactory
    {
        return TemporaryUploadFactory::new();
    }

<<<<<<< HEAD
    public static null|Closure $manipulatePreview = null;

    public static null|string $disk = null;
=======
    public static ?Closure $manipulatePreview = null;

    public static ?string $disk = null;
>>>>>>> 0a466ed (.)

    /** @var string */
    protected $connection = 'media';

    /**
     * @var array<string>
     */
    protected $guarded = [];

<<<<<<< HEAD
    public static function findByMediaUuid(null|string $mediaUuid): null|self
=======
    public static function findByMediaUuid(?string $mediaUuid): ?self
>>>>>>> 0a466ed (.)
    {
        Assert::string($mediaModelClass = config('media-library.media_model'));

        /**
         * @var Media $media
         */
<<<<<<< HEAD
        $media = $mediaModelClass::query()->where('uuid', $mediaUuid)->first();

        if (!$media) {
=======
        $media = $mediaModelClass::query()
            ->where('uuid', $mediaUuid)
            ->first();

        if (! $media) {
>>>>>>> 0a466ed (.)
            return null;
        }

        $temporaryUpload = $media->model;

<<<<<<< HEAD
        if (!($temporaryUpload instanceof self)) {
=======
        if (! $temporaryUpload instanceof self) {
>>>>>>> 0a466ed (.)
            return null;
        }

        return $temporaryUpload;
    }

<<<<<<< HEAD
    public static function findByMediaUuidInCurrentSession(null|string $mediaUuid): null|self
    {
        if (!(($temporaryUpload = static::findByMediaUuid($mediaUuid)) instanceof self)) {
            return null;
        }

        if (
            config('media-library.enable_temporary_uploads_session_affinity', true) &&
                $temporaryUpload->session_id !== session()->getId()
        ) {
=======
    public static function findByMediaUuidInCurrentSession(?string $mediaUuid): ?self
    {
        if (! ($temporaryUpload = static::findByMediaUuid($mediaUuid)) instanceof self) {
            return null;
        }

        if (config('media-library.enable_temporary_uploads_session_affinity', true) && $temporaryUpload->session_id !== session()->getId()) {
>>>>>>> 0a466ed (.)
            return null;
        }

        return $temporaryUpload;
    }

    public static function createForFile(
        UploadedFile $uploadedFile,
        string $sessionId,
        string $uuid,
        string $name,
    ): self {
        /**
         * @var TemporaryUpload $temporaryUpload
         */
<<<<<<< HEAD
        $temporaryUpload = static::create([
            'session_id' => $sessionId,
        ]);
=======
        $temporaryUpload = static::create(
            [
                'session_id' => $sessionId,
            ]
        );
>>>>>>> 0a466ed (.)

        if (static::findByMediaUuid($uuid) instanceof self) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMedia($uploadedFile)
            ->setName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());
        // Debugbar::info('TemporaruUpload UUID', $uuid);
        $temporaryUpload->fresh();

        return $temporaryUpload;
    }

    public static function createForRemoteFile(
        string $file,
        string $sessionId,
        string $uuid,
        string $name,
        string $diskName,
    ): self {
        /**
         * @var TemporaryUpload $temporaryUpload
         */
<<<<<<< HEAD
        $temporaryUpload = static::create([
            'session_id' => $sessionId,
        ]);
=======
        $temporaryUpload = static::create(
            [
                'session_id' => $sessionId,
            ]
        );
>>>>>>> 0a466ed (.)

        if (static::findByMediaUuid($uuid) instanceof self) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $temporaryUpload
            ->addMediaFromDisk($file, $diskName)
            ->setName($name)
            ->usingFileName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        $temporaryUpload->fresh();

        return $temporaryUpload;
    }

<<<<<<< HEAD
    public function registerMediaConversions(null|Media $media = null): void
    {
        if (!config('media-library.generate_thumbnails_for_temporary_uploads')) {
            return;
        }

        $conversion = $this->addMediaConversion('preview')->nonQueued();
=======
    public function registerMediaConversions(?Media $media = null): void
    {
        if (! config('media-library.generate_thumbnails_for_temporary_uploads')) {
            return;
        }

        $conversion = $this
            ->addMediaConversion('preview')
            ->nonQueued();
>>>>>>> 0a466ed (.)

        $previewManipulation = $this->getPreviewManipulation();

        $previewManipulation($conversion);
    }

    public function moveMedia(HasMedia $hasMedia, string $collectionName, string $diskName, string $fileName): Media
    {
<<<<<<< HEAD
        if (
            config('media-library.enable_temporary_uploads_session_affinity', true) &&
                $this->session_id !== session()->getId()
        ) {
=======
        if (config('media-library.enable_temporary_uploads_session_affinity', true) && $this->session_id !== session()->getId()) {
>>>>>>> 0a466ed (.)
            throw TemporaryUploadDoesNotBelongToCurrentSession::create();
        }

        $media = $this->getFirstMedia();

        // if (! $media instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media) {
        //    throw new \Exception('['.__LINE__.']['.class_basename($this).']');
        // }
<<<<<<< HEAD
        Assert::isInstanceOf($media, Media::class, '[' . __LINE__ . '][' . class_basename($this) . ']');
=======
        Assert::isInstanceOf($media, Media::class, '['.__LINE__.']['.class_basename($this).']');
>>>>>>> 0a466ed (.)

        $temporaryUploadModel = $media->model;
        $uuid = $media->uuid;

        $newMedia = $media->move($hasMedia, $collectionName, $diskName, $fileName);

        $temporaryUploadModel?->delete();

        $newMedia->update(['uuid' => $uuid]);

        return $newMedia;
    }

    protected static function getDiskName(): string
    {
        $res = static::$disk ?? config('media-library.disk_name');
        if (\is_string($res)) {
            return $res;
        }
<<<<<<< HEAD
        throw new Exception('[' . __LINE__ . '][' . class_basename(__CLASS__) . ']');
=======
        throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
>>>>>>> 0a466ed (.)
    }

    // public function prunable(): Builder
    // { Call to an undefined method Illuminate\Database\Eloquent\Builder<Modules\Media\Models\TemporaryUpload>::old().
    //    return self::query()->old();
    // }

    protected function getPreviewManipulation(): Closure
    {
<<<<<<< HEAD
        return (
            static::$manipulatePreview ?? function (Conversion $conversion): void {
                $conversion->fit(Fit::Crop, 300, 300);

                // $conversion->fit('crop', 300, 300);
            }
        );
=======
        return static::$manipulatePreview ?? function (Conversion $conversion): void {
            $conversion->fit(Fit::Crop, 300, 300);
            // $conversion->fit('crop', 300, 300);
        };
>>>>>>> 0a466ed (.)
    }
}
