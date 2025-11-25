<?php

declare(strict_types=1);

namespace Modules\Media\Datas;

use RuntimeException;
<<<<<<< HEAD
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Wireable;
use Modules\Tenant\Services\TenantService;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

=======
use Livewire\Wireable;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Modules\Tenant\Services\TenantService;
use Spatie\LaravelData\Concerns\WireableData;
>>>>>>> 0a466ed (.)
use function Safe\file_get_contents;

class CloudFrontData extends Data implements Wireable
{
    use WireableData;

    public string $region; //' => env('CLOUDFRONT_REGION', 'eu-west-1'),
    public string $base_url; //' => env('CLOUDFRONT_RESOURCE_KEY_BASE_URL'),
<<<<<<< HEAD
    public null|string $private_key; //' => env('CLOUDFRONT_PRIVATE_KEY'),
    public null|string $private_key_path; //' => env('CLOUDFRONT_PRIVATE_KEY_PATH'),
    public string $key_pair_id; //' => env('CLOUDFRONT_KEYPAIR_ID'),

    /**
     * Singleton instance.
     */
    private static null|self $instance = null;
=======
    public ?string $private_key; //' => env('CLOUDFRONT_PRIVATE_KEY'),
    public ?string $private_key_path; //' => env('CLOUDFRONT_PRIVATE_KEY_PATH'),
    public string $key_pair_id; //' => env('CLOUDFRONT_KEYPAIR_ID'),


     /**
     * Singleton instance.
     */
    private static ?self $instance = null;
>>>>>>> 0a466ed (.)

    /**
     * Creates or returns the singleton instance.
     *
     * @return self
     */
    public static function make(): self
    {
<<<<<<< HEAD
        if (!self::$instance) {
=======
        if (! self::$instance) {
>>>>>>> 0a466ed (.)
            /** @var array<string, mixed> $data */
            $data = Config::array('services.cloudfront');
            self::$instance = self::from($data);
        }

        return self::$instance;
    }

    public function getPrivateKey(): string
    {
        if ($this->private_key) {
            return $this->private_key;
        }
        if ($this->private_key_path) {
            return file_get_contents(storage_path($this->private_key_path));
        }
        throw new RuntimeException('CLOUDFRONT_PRIVATE_KEY environment variable is not set or empty');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 0a466ed (.)
