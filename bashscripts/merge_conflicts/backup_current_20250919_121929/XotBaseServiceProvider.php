<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Exception;
use Throwable;
use Modules\Xot\Actions\File\GetComponentsAction;
use BladeUI\Icons\Factory as BladeIconsFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
<<<<<<< HEAD
use Illuminate\Support\Facades\File;
=======
>>>>>>> f1d4085 (.)
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
use Modules\Xot\Actions\Livewire\RegisterLivewireComponentsAction;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;
use Nwidart\Modules\Traits\PathNamespace;
use Webmozart\Assert\Assert;

/**
 * Class XotBaseServiceProvider.
 */
abstract class XotBaseServiceProvider extends ServiceProvider
{
    use PathNamespace;

    public string $name = '';

    public string $nameLower = '';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    protected string $module_base_ns;

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
<<<<<<< HEAD
        $this->loadMigrationsFrom($this->module_dir . '/../Database/Migrations');
=======
        $this->loadMigrationsFrom($this->module_dir.'/../Database/Migrations');
>>>>>>> f1d4085 (.)
        $this->registerLivewireComponents();
        $this->registerBladeComponents();
        $this->registerCommands();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->nameLower = Str::lower($this->name);
        $this->module_ns = collect(explode('\\', $this->module_ns))->slice(0, -1)->implode('\\');
<<<<<<< HEAD
        $this->app->register($this->module_ns . '\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns . '\Providers\EventServiceProvider');
=======
        $this->app->register($this->module_ns.'\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns.'\Providers\EventServiceProvider');
>>>>>>> f1d4085 (.)
        $this->registerBladeIcons();
    }

    public function registerBladeIcons(): void
    {
        if ($this->name === '') {
<<<<<<< HEAD
            throw new Exception('name is empty on [' . static::class . ']');
=======
            throw new Exception('name is empty on ['.static::class.']');
>>>>>>> f1d4085 (.)
        }

        $this->callAfterResolving(BladeIconsFactory::class, function (BladeIconsFactory $factory) {
            $assetsPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'assets');
<<<<<<< HEAD
            $svgPath = $assetsPath . '/../svg';
=======
            $svgPath = $assetsPath.'/../svg';
>>>>>>> f1d4085 (.)
            try {
                $factory->add($this->nameLower, ['path' => $svgPath, 'prefix' => $this->nameLower]);
            } catch (Throwable $e) {
                // Ignore missing SVG path
            }
        });
<<<<<<< HEAD

        // $svgPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'svg');
        /*
         * Assert::string($relativePath = config('modules.paths.generator.assets.path'));
         *
         * try {
         * $svgPath = module_path($this->name, $relativePath.'/../svg');
         * if (! is_string($svgPath)) {
         * throw new \Exception('Invalid SVG path');
         * }
         * $resolvedPath = $svgPath;
         * $svgPath = $resolvedPath;
         * } catch (\Error $e) {
         * $svgPath = base_path('Modules/'.$this->name.'/'.$relativePath.'/../svg');
         * if (! is_string($svgPath)) {
         * throw new \Exception('Invalid fallback SVG path');
         * }
         * }
         *
         * $basePath = base_path(DIRECTORY_SEPARATOR);
         * $svgPath = str_replace($basePath, '', $svgPath);
         *
         * Config::set('blade-icons.sets.'.$this->nameLower.'.path', $svgPath);
         * Config::set('blade-icons.sets.'.$this->nameLower.'.prefix', $this->nameLower);
         */
=======
        // $svgPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'svg');
        /*
        Assert::string($relativePath = config('modules.paths.generator.assets.path'));

        try {
            $svgPath = module_path($this->name, $relativePath.'/../svg');
            if (! is_string($svgPath)) {
                throw new \Exception('Invalid SVG path');
            }
            $resolvedPath = $svgPath;
            $svgPath = $resolvedPath;
        } catch (\Error $e) {
            $svgPath = base_path('Modules/'.$this->name.'/'.$relativePath.'/../svg');
            if (! is_string($svgPath)) {
                throw new \Exception('Invalid fallback SVG path');
            }
        }

        $basePath = base_path(DIRECTORY_SEPARATOR);
        $svgPath = str_replace($basePath, '', $svgPath);

        Config::set('blade-icons.sets.'.$this->nameLower.'.path', $svgPath);
        Config::set('blade-icons.sets.'.$this->nameLower.'.prefix', $this->nameLower);
        */
>>>>>>> f1d4085 (.)
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        if ($this->name === '') {
<<<<<<< HEAD
            throw new Exception('name is empty on [' . static::class . ']');
=======
            throw new Exception('name is empty on ['.static::class.']');
>>>>>>> f1d4085 (.)
        }

        $viewPath = module_path($this->name, 'resources/views');
        // if (! is_string($viewPath)) {
        //    throw new \Exception('Invalid view path');
        // }

        $this->loadViewsFrom($viewPath, $this->nameLower);
    }

    /**
     * Restituisce il path della cartella lang del modulo, con fallback robusto.
     */
    protected function getLangPath(): string
    {
        try {
            return app(GetModulePathByGeneratorAction::class)->execute($this->name, 'lang');
        } catch (Throwable $e) {
<<<<<<< HEAD
            return base_path('Modules/' . $this->name . '/lang');
=======
            return base_path('Modules/'.$this->name.'/lang');
>>>>>>> f1d4085 (.)
        }
    }

    /**
     * Registra le traduzioni del modulo.
     *
     * @throws Exception
     */
    public function registerTranslations(): void
    {
        if ($this->name === '') {
<<<<<<< HEAD
            throw new Exception('name is empty on [' . static::class . ']');
=======
            throw new Exception('name is empty on ['.static::class.']');
>>>>>>> f1d4085 (.)
        }

        $langPath = $this->getLangPath();
        $this->loadTranslationsFrom($langPath, $this->nameLower);
        $this->loadJsonTranslationsFrom($langPath);
    }

    /**
     * Register an additional directory of factories.
     */
    public function registerFactories(): void
    {
<<<<<<< HEAD
        if (!app()->environment('production')) {
=======
        if (! app()->environment('production')) {
>>>>>>> f1d4085 (.)
            // app(Factory::class)->load($this->module_dir.'/../Database/factories');
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        try {
            $configPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'config');

<<<<<<< HEAD
            $files = File::glob($configPath . '/*.php');

            foreach ($files as $file) {
                $content = File::getRequire($file);
                $info = pathinfo($file);
                $key = $this->nameLower . '::' . $info['filename'];
                Config::set($key, $content);
            }
=======
            $this->mergeConfigFrom($configPath, $this->nameLower);
>>>>>>> f1d4085 (.)
        } catch (Exception $e) {
            // Ignore missing configuration
            return;
        }
    }

    public function registerBladeComponents(): void
    {
        $componentViewPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-view');
        Blade::anonymousComponentPath($componentViewPath);

        $componentClassPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-class');

<<<<<<< HEAD
        $namespace = $this->module_ns . '\View\Components';
        Blade::componentNamespace($namespace, $this->nameLower);

        app(RegisterBladeComponentsAction::class)->execute($componentClassPath, $this->module_ns);
=======
        $namespace = $this->module_ns.'\View\Components';
        Blade::componentNamespace($namespace, $this->nameLower);

        app(RegisterBladeComponentsAction::class)
            ->execute(
                $componentClassPath,
                $this->module_ns
            );
>>>>>>> f1d4085 (.)
    }

    /**
     * Register Livewire components.
     */
    public function registerLivewireComponents(): void
    {
        $prefix = '';
        app(RegisterLivewireComponentsAction::class)
<<<<<<< HEAD
            ->execute($this->module_dir . '/../Http/Livewire', Str::before($this->module_ns, '\Providers'), $prefix);
=======
            ->execute(
                $this->module_dir.'/../Http/Livewire',
                Str::before($this->module_ns, '\Providers'),
                $prefix
            );
>>>>>>> f1d4085 (.)
    }

    public function registerCommands(): void
    {
        $prefix = '';

        $comps = app(GetComponentsAction::class)
            ->execute(
<<<<<<< HEAD
                $this->module_dir . '/../Console/Commands',
                'Modules\\' . $this->name . '\\Console\\Commands',
                $prefix,
            );
        if ($comps->count() === 0) {
=======
                $this->module_dir.'/../Console/Commands',
                'Modules\\'.$this->name.'\\Console\\Commands',
                $prefix,
            );
        if ($comps->count() == 0) {
>>>>>>> f1d4085 (.)
            return;
        }
        $commands = $comps->toArray();
        /** @var array<int, array{ns: string}> $commands */
<<<<<<< HEAD
        $commands = array_map(static function (mixed $item): string {
            Assert::isArray($item);
            Assert::keyExists($item, 'ns');
            Assert::string($item['ns'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

            return $item['ns'];
        }, $commands);
=======
        $commands = array_map(
            static function (mixed $item): string {
                Assert::isArray($item);
                Assert::keyExists($item, 'ns');
                Assert::string($item['ns']);

                return $item['ns'];
            },
            $commands
        );
>>>>>>> f1d4085 (.)
        $this->commands($commands);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [];
    }
}
