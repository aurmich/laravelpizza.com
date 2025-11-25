<?php

declare(strict_types=1);

namespace Modules\Cms\Providers;

<<<<<<< HEAD
use Override;
use Modules\Xot\Actions\File\FixPathAction;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Webmozart\Assert\Assert;
=======
use Modules\Xot\Actions\File\FixPathAction;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Modules\Xot\Providers\XotBaseServiceProvider;
>>>>>>> 3401a6b (.)

class CmsServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Cms';
    public XotData $xot;
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

<<<<<<< HEAD
    #[Override]
=======

>>>>>>> 3401a6b (.)
    public function boot(): void
    {
        parent::boot();

        $this->xot = XotData::make();

        if ($this->xot->register_pub_theme) {
            $this->registerNamespaces('pub_theme');

            //$this->registerThemeConfig('pub_theme');
            //$this->registerThemeLivewireComponents();
        }
<<<<<<< HEAD
=======
        
>>>>>>> 3401a6b (.)
    }

    /**
     * Register the service provider.
     */
<<<<<<< HEAD
    #[Override]
    public function register(): void
    {
=======
    public function register(): void
    {

>>>>>>> 3401a6b (.)
        parent::register();

        $this->xot = XotData::make();

        // Verifica che la configurazione di LaravelLocalization sia caricata
        // NOTA: La configurazione è già gestita dal modulo Lang
        // if (!config()->has('laravellocalization.supportedLocales')) {
        //     $this->mergeConfigFrom(__DIR__.'/../config/laravellocalization.php', 'laravellocalization');
        // }

        if ($this->xot->register_pub_theme) {
            Assert::isArray($paths = config('view.paths'));
<<<<<<< HEAD
            $theme_path = app(FixPathAction::class)
                ->execute(base_path('Themes/' . $this->xot->pub_theme . '/resources/views'));
            $paths = array_merge([$theme_path], $paths);
            Config::set('view.paths', $paths);
            Config::set('livewire.view_path', $theme_path . '/livewire');
            Config::set('livewire.class_namespace', 'Themes\\' . $this->xot->pub_theme . '\Http\Livewire');

            //$this->registerFolio();
        }
    }

=======
            $theme_path = app(FixPathAction::class)->execute(base_path('Themes/'.$this->xot->pub_theme.'/resources/views'));
            $paths = array_merge([$theme_path], $paths);
            Config::set('view.paths', $paths);
            Config::set('livewire.view_path', $theme_path.'/livewire');
            Config::set('livewire.class_namespace', 'Themes\\'.$this->xot->pub_theme.'\Http\Livewire');
            //$this->registerFolio();
        }

        
    }


>>>>>>> 3401a6b (.)
    public function registerNamespaces(string $theme_type): void
    {
        $xot = $this->xot;

<<<<<<< HEAD
        Assert::string($theme = $xot->{$theme_type}, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $theme_path = 'Themes/' . $theme;
        $resource_path = $theme_path . '/resources';
        $lang_dir = app(FixPathAction::class)->execute(base_path($theme_path . '/lang'));

        $theme_dir = app(FixPathAction::class)->execute(base_path($resource_path . '/views'));

        app('view')->addNamespace($theme_type, $theme_dir);
        $this->loadTranslationsFrom($lang_dir, $theme_type);

        $componentViewPath = app(FixPathAction::class)
            ->execute(base_path($resource_path . '/views/components'));

=======
        Assert::string($theme = $xot->{$theme_type});
        $theme_path='Themes/'.$theme;
        $resource_path = $theme_path.'/resources';
        $lang_dir = app(FixPathAction::class)->execute(base_path($theme_path.'/lang'));

        $theme_dir = app(FixPathAction::class)->execute(base_path($resource_path.'/views'));
        
        app('view')->addNamespace($theme_type, $theme_dir);
        $this->loadTranslationsFrom($lang_dir, $theme_type);

        $componentViewPath = app(FixPathAction::class)->execute(base_path($resource_path.'/views/components'));
        
>>>>>>> 3401a6b (.)
        Blade::anonymousComponentPath($componentViewPath);
    }
}
