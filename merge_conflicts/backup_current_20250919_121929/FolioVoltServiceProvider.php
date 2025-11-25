<?php

declare(strict_types=1);

namespace Modules\Cms\Providers;

use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
<<<<<<< HEAD
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;
use Livewire\Volt\Volt;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Webmozart\Assert\Assert;
=======
use Livewire\Volt\Volt;
use Laravel\Folio\Folio;
use Illuminate\Support\Arr;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Illuminate\Support\Collection;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Tenant\Services\TenantService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
>>>>>>> 3401a6b (.)

class FolioVoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
<<<<<<< HEAD
        
=======
        //
>>>>>>> 3401a6b (.)
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /*
<<<<<<< HEAD
         * Folio::path(resource_path('views/pages'))->middleware([
         * '*' => [
         * //
         * ],
         * ]);
         */
        $middleware = TenantService::config('middleware');
        if (!is_array($middleware)) {
=======
        Folio::path(resource_path('views/pages'))->middleware([
            '*' => [
                //
            ],
        ]);
        */
        $middleware = TenantService::config('middleware');
        if (! is_array($middleware)) {
>>>>>>> 3401a6b (.)
            $middleware = [];
        }
        Assert::isArray($base_middleware = Arr::get($middleware, 'base', []));

        //$base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class;
<<<<<<< HEAD
        $base_middleware[] = LocaleSessionRedirect::class;
        $base_middleware[] = LaravelLocalizationRedirectFilter::class;
=======
        $base_middleware[]=LocaleSessionRedirect::class;
        $base_middleware[]=LaravelLocalizationRedirectFilter::class;
>>>>>>> 3401a6b (.)
        //$base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class;
        //$base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class;

        $theme_path = XotData::make()->getPubThemeViewPath('pages');
        /*
<<<<<<< HEAD
         * // Ottieni la lingua corrente in modo sicuro
         * $currentLocale = app()->getLocale();
         * $supportedLocales = config('laravellocalization.supportedLocales', []);
         * if (!isset($supportedLocales[$currentLocale])) {
         * $currentLocale = array_key_first($supportedLocales) ?? 'it';
         * app()->setLocale($currentLocale);
         * }
         */
        //$currentLocale = LaravelLocalization::setLocale() ?? app()->getLocale();

        Folio::path($theme_path)
            ->uri(LaravelLocalization::setLocale() ?? app()->getLocale())
=======
        // Ottieni la lingua corrente in modo sicuro
        $currentLocale = app()->getLocale();
        $supportedLocales = config('laravellocalization.supportedLocales', []);
        if (!isset($supportedLocales[$currentLocale])) {
            $currentLocale = array_key_first($supportedLocales) ?? 'it';
            app()->setLocale($currentLocale);
        }
        */
        //$currentLocale = LaravelLocalization::setLocale() ?? app()->getLocale();

        Folio::path($theme_path)
            ->uri(LaravelLocalization::setLocale() ?? app()->getLocale() )
>>>>>>> 3401a6b (.)
            //->uri('{lang}')
            ->middleware([
                '*' => $base_middleware,
            ]);

        /**
         * @var Collection<Module>
         */
        $modules = Module::collections();
        $paths = [];
        $paths[] = $theme_path;
        foreach ($modules as $module) {
<<<<<<< HEAD
            $path = $module->getPath() . '/resources/views/pages';
            if (!File::exists($path)) {
=======
            $path = $module->getPath().'/resources/views/pages';
            if (! File::exists($path)) {
>>>>>>> 3401a6b (.)
                continue;
            }
            $paths[] = $path;
            Folio::path($path)
<<<<<<< HEAD
                ->uri(LaravelLocalization::setLocale() ?? app()->getLocale())
                //->uri('{lang}')
                ->middleware([
                    '*' => $base_middleware,
=======
                ->uri( LaravelLocalization::setLocale() ?? app()->getLocale() )
                //->uri('{lang}')
                ->middleware([
                    '*' => $base_middleware
>>>>>>> 3401a6b (.)
                ]);
        }

        Volt::mount($paths);
    }
}
