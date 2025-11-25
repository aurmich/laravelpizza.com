<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Filament;

<<<<<<< HEAD
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Filament\Support\Colors\Color;
use Modules\Xot\Datas\MetatagData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Modules\Xot\Actions\Panel\ApplyMetatagToPanelAction;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Modules\Xot\Actions\Filament\GetModulesNavigationItems;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
=======
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Xot\Actions\Panel\ApplyMetatagToPanelAction;
use Modules\Xot\Datas\MetatagData;
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;
>>>>>>> f1d4085 (.)

abstract class XotBasePanelProvider extends PanelProvider
{
    protected string $module;

    protected bool $topNavigation = false;

    protected bool $globalSearch = false;

    protected bool $navigation = true;

    public function panel(Panel $panel): Panel
    {
        $moduleNamespace = $this->getModuleNamespace();
        $moduleLow = Str::lower($this->module);
        $metatag = MetatagData::make();

        $main_module = Str::lower(XotData::make()->main_module);
<<<<<<< HEAD
        $default = $main_module === $moduleLow;
=======
        $default = ($main_module === $moduleLow);
>>>>>>> f1d4085 (.)

        $panel = $panel
            ->default($default)
            // ->login()
            // ->registration()
            ->passwordReset()
            // ->emailVerification()
            // ->profile()
            ->sidebarFullyCollapsibleOnDesktop();

        app(ApplyMetatagToPanelAction::class)->execute(panel: $panel);
        // ---------------------
<<<<<<< HEAD
        $panel
            ->maxContentWidth('full')
=======
        $panel->maxContentWidth('full')
>>>>>>> f1d4085 (.)
            ->topNavigation($this->topNavigation)
            ->globalSearch($this->globalSearch)
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->navigation($this->navigation)
            // ->tenant($teamClass)
            // ->tenant($teamClass,ownershipRelationship:'users')
            // ->tenant($teamClass)
<<<<<<< HEAD
            ->id($moduleLow . '::admin')
            ->path($moduleLow . '/admin')
            // Configure Filament discovery for module components (unconditional; dirs are expected to exist)
            ->discoverResources(
                in: base_path('Modules/' . $this->module . '/app/Filament/Resources'),
                for: sprintf('%s\\Filament\\Resources', $moduleNamespace),
            )
            ->discoverPages(
                in: base_path('Modules/' . $this->module . '/app/Filament/Pages'),
                for: sprintf('%s\\Filament\\Pages', $moduleNamespace),
            )
            ->discoverWidgets(
                in: base_path('Modules/' . $this->module . '/app/Filament/Widgets'),
                for: sprintf('%s\\Filament\\Widgets', $moduleNamespace),
            )
            ->discoverClusters(
                in: base_path('Modules/' . $this->module . '/app/Filament/Clusters'),
                for: sprintf('%s\\Filament\\Clusters', $moduleNamespace),
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

       

=======
            ->id($moduleLow.'::admin')
            ->path($moduleLow.'/admin')
            ->discoverResources(
                in: base_path('Modules/'.$this->module.'/app/Filament/Resources'),
                for: sprintf('%s\Filament\Resources', $moduleNamespace)
            )
            ->discoverPages(
                in: base_path('Modules/'.$this->module.'/app/Filament/Pages'),
                for: sprintf('%s\Filament\Pages', $moduleNamespace)
            )
            ->pages(
                [
                    // Dashboard::class,
                ]
            )
            ->discoverWidgets(
                in: base_path('Modules/'.$this->module.'/app/Filament/Widgets'),
                for: sprintf('%s\Filament\Widgets', $moduleNamespace)
            )
            ->widgets(
                [
                    // Widgets\AccountWidget::class,
                    // Widgets\FilamentInfoWidget::class,
                ]
            )
            ->discoverClusters(
                in: base_path('Modules/'.$this->module.'/app/Filament/Clusters'),
                for: sprintf('%s\Filament\Clusters', $moduleNamespace)
            )
            /*
            $panel->discoverLivewireComponents(
                in: $module->appPath('Livewire'),
                for: $module->appNamespace('\\Livewire')
            )
            */
            ->discoverLivewireComponents(
                in: base_path('Modules/'.$this->module.'/app/Http/Livewire'),
                for: sprintf('%s\Http\Livewire', $moduleNamespace)
            )
            ->middleware(
                [
                    EncryptCookies::class,
                    AddQueuedCookiesToResponse::class,
                    StartSession::class,
                    AuthenticateSession::class,
                    ShareErrorsFromSession::class,
                    VerifyCsrfToken::class,
                    SubstituteBindings::class,
                    DisableBladeIconComponents::class,
                    DispatchServingFilamentEvent::class,
                ]
            )
            ->authMiddleware(
                [
                    Authenticate::class,
                ]
            );

       
>>>>>>> f1d4085 (.)
        return $panel;
    }

    protected function getModuleNamespace(): string
    {
        Assert::string($ns = config('modules.namespace'));

<<<<<<< HEAD
        return $ns . '\\' . $this->module;
=======
        return $ns.'\\'.$this->module;
>>>>>>> f1d4085 (.)
    }
}
