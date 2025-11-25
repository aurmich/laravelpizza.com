<?php

/**
 * @see https://laraveldaily.com/post/filament-custom-edit-profile-page-multiple-forms-full-design
 */

declare(strict_types=1);

namespace Modules\Cms\Filament\Front\Pages;

use Exception;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Webmozart\Assert\Assert;

// implements HasTable
class Welcome extends Page
{
    public string $view_type;

    public array $containers = [];

    public array $items = [];

<<<<<<< HEAD
    public null|Model $model = null;
=======
    public ?Model $model = null;
>>>>>>> 3401a6b (.)
    // use InteractsWithTable;
    // use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'cms::filament.front.pages.welcome';
    protected string $view = 'pub_theme::home';

    protected static string $layout = 'pub_theme::components.layouts.app';

    public function mount(): void
    {
        $lang = request('lang') ?? app()->getLocale();
        if (is_string($lang)) {
            app()->setLocale($lang);
        }
<<<<<<< HEAD
        [$this->containers, $this->items] = params2ContainerItem();
=======
        [$this->containers,$this->items] = params2ContainerItem();
>>>>>>> 3401a6b (.)
        $this->initView();
    }

    public function getViewData(): array
    {
        $data = [];
        if ([] !== $this->containers) {
<<<<<<< HEAD
            Assert::string($container_last = last($this->containers),'['.__LINE__.']['.__FILE__.']');
=======
            Assert::string($container_last = last($this->containers));
>>>>>>> 3401a6b (.)
            $item_last = last($this->items);

            $container_last_singular = Str::singular($container_last);

            $container_last_model = TenantService::model($container_last_singular);
<<<<<<< HEAD
            if (!method_exists($container_last_model, 'getFrontRouteKeyName')) {
                throw new Exception('[WIP][' . __LINE__ . '][' . __FILE__ . ']');
=======
            if (! method_exists($container_last_model, 'getFrontRouteKeyName')) {
                throw new Exception('[WIP]['.__LINE__.']['.__FILE__.']');
>>>>>>> 3401a6b (.)
            }
            $container_last_key_name = $container_last_model->getFrontRouteKeyName();

            $row = $container_last_model::firstWhere([$container_last_key_name => $item_last]);

            $data[$container_last_singular] = $row;

            if (null === $row) {
                abort(404);
            }
        }

        return $data;
    }

    public function initView(): void
    {
        $containers = $this->containers;
        $items = $this->items;

        $view = '';
        if (\count($containers) === \count($items)) {
            $view = 'show';
        }
        if (\count($containers) > \count($items)) {
            $view = 'index';
        }
        if ([] === $containers) {
            $view = 'home';
        }

        $this->view_type = $view;

        $views = [];

        if ([] !== $containers) {
<<<<<<< HEAD
            $views[] = 'pub_theme::' . implode('.', $containers) . '.' . $view;
            Assert::string($model_class = TenantService::modelClass($containers[0]), __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
            $module_name = Str::between($model_class, 'Modules\\', '\Models\\');
            $module_name_low = Str::lower($module_name);
            $views[] = $module_name_low . '::' . implode('.', $containers) . '.' . $view;
        } else {
            $views[] = 'pub_theme::' . $view;
        }

        $view_work = Arr::first($views, view()->exists(...));
=======
            $views[] = 'pub_theme::'.implode('.', $containers).'.'.$view;
            Assert::string($model_class = TenantService::modelClass($containers[0]));
            $module_name = Str::between($model_class, 'Modules\\', '\Models\\');
            $module_name_low = Str::lower($module_name);
            $views[] = $module_name_low.'::'.implode('.', $containers).'.'.$view;
        } else {
            $views[] = 'pub_theme::'.$view;
        }

        $view_work = Arr::first(
            $views,
            static fn (string $view) => view()->exists($view)
        );
>>>>>>> 3401a6b (.)

        if (null === $view_work) {
            dddx($views);
        }
<<<<<<< HEAD
        Assert::string($view_work, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));

        $this->view = $view_work;
=======
        Assert::string($view_work);

        self::$view = $view_work;
>>>>>>> 3401a6b (.)
    }

    public function url(string $name = 'show', array $parameters = []): string
    {
        // dddx($parameters);
        $parameters['lang'] = app()->getLocale();
        $record = $parameters['record'] ?? $this->model;
        // dddx($record);
        if ('show' === $name) {
            $container0 = class_basename($record);
            $container0 = Str::plural($container0);
            $container0 = Str::snake($container0);
            $parameters['container0'] = $container0;
            $parameters['item0'] = $record->slug;

            // dddx($parameters);
            // unset($parameters['record']); // per togliere quel ?record=n dall'url, che non dovrebbe servire?
            return route('test', $parameters);
        }
        if ('index' === $name) {
            $container0 = class_basename($record);
            $container0 = Str::plural($container0);
            $container0 = Str::snake($container0);
            $parameters['container0'] = $container0;

            return route('test', $parameters);
        }
        $parameters['container0'] = 'articles';
        $parameters['item0'] = 'zibibbo';

        return route('test', $parameters);
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }
}
