<?php

declare(strict_types=1);

namespace Modules\Cms\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;
use Livewire\Volt\Volt;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Webmozart\Assert\Assert;

class FolioVoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /*
         * Folio::path(resource_path('views/pages'))->middleware([
         * '*' => [
         * //
         * ],
         * ]);
         */
        try {
            $middleware = TenantService::config('middleware');
            if (! is_array($middleware)) {
                $middleware = [];
            }
            Assert::isArray($base_middleware = Arr::get($middleware, 'base', []));
        } catch (\Exception $e) {
            // Se c'è un errore nel caricamento della configurazione middleware, usa array vuoto
            // Questo evita errori durante il bootstrap quando la configurazione non è disponibile
            $base_middleware = [];
        }

        // $base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class;
        $base_middleware[] = LocaleSessionRedirect::class;
        $base_middleware[] = LaravelLocalizationRedirectFilter::class;
        // $base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class;
        // $base_middleware[]=\Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class;

        $theme_path = XotData::make()->getPubThemeViewPath('pages');
        /*
         * // Ottieni la lingua corrente in modo sicuro
         * $currentLocale = app()->getLocale();
         * $supportedLocales = config('laravellocalization.supportedLocales', []);
         * if (!isset($supportedLocales[$currentLocale])) {
         * $currentLocale = array_key_first($supportedLocales) ?? 'it';
         * app()->setLocale($currentLocale);
         * }
         */
        // $currentLocale = LaravelLocalization::setLocale() ?? app()->getLocale();

        /**
         * @var Collection<int, \Nwidart\Modules\Module> $modules
         */
        $modules = Module::all();
        $paths = [];

        // Verifica che il percorso tema esista e sia una directory prima di passarlo a Folio
        if (File::exists($theme_path) && File::isDirectory($theme_path)) {
            $locale = LaravelLocalization::setLocale() ?: app()->getLocale();
            Folio::path($theme_path)
                ->uri($locale)
                // ->uri('{lang}')
                ->middleware([
                    '*' => $base_middleware,
                ]);
            $paths[] = $theme_path;
        }

        foreach ($modules as $module) {
            $path = $module->getPath().'/resources/views/pages';
            if (! File::exists($path) || ! File::isDirectory($path)) {
                continue;
            }
            $paths[] = $path;
            $locale = LaravelLocalization::setLocale() ?: app()->getLocale();
            Folio::path($path)
                ->uri($locale)
                // ->uri('{lang}')
                ->middleware([
                    '*' => $base_middleware,
                ]);
        }

        if (! empty($paths)) {
            Volt::mount($paths);
        }
    }
}
