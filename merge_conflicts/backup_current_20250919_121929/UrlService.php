<?php

/**
 * @see https://www.webslesson.info/2019/02/import-excel-file-in-laravel.html
 * @see https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/
 */

declare(strict_types=1);

namespace Modules\Xot\Services;

/**
 * Undocumented class.
 */
class UrlService
{
<<<<<<< HEAD
    private static null|self $instance = null;
=======
    private static ?self $instance = null;
>>>>>>> f1d4085 (.)

    public function __construct()
    {
        // ---
<<<<<<< HEAD
        include_once __DIR__ . '/vendor/autoload.php';
=======
        include_once __DIR__.'/vendor/autoload.php';
>>>>>>> f1d4085 (.)
    }

    public static function getInstance(): self
    {
<<<<<<< HEAD
        if (!(self::$instance instanceof self)) {
=======
        if (! self::$instance instanceof self) {
>>>>>>> f1d4085 (.)
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Undocumented function.
     */
    public static function make(): self
    {
        return static::getInstance();
    }

    public function checkValidUrl(string $url): bool
    {
        return false !== filter_var($url, FILTER_VALIDATE_URL);
    }
}
