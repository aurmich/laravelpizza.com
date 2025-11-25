<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Filament;

use Exception;
<<<<<<< HEAD
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Modules\Xot\Datas\MetatagData;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Filament\Http\Middleware\Authenticate;
use Modules\Xot\Filament\Pages\MainDashboard;
use Modules\User\Filament\Pages\MyProfilePage;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
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
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\User\Filament\Pages\MyProfilePage;
use Modules\Xot\Actions\Filament\GetModulesNavigationItems;
use Modules\Xot\Actions\Panel\ApplyMetatagToPanelAction;
use Modules\Xot\Datas\MetatagData;
use Modules\Xot\Filament\Pages\MainDashboard;
use Nwidart\Modules\Facades\Module;
>>>>>>> f1d4085 (.)

abstract class XotBaseMainPanelProvider extends PanelProvider
{
    protected bool $topNavigation = false;

    public function panel(Panel $panel): Panel
    {
        $metatag = MetatagData::make();

<<<<<<< HEAD
        $panel->id('admin')->path('admin');

        if (!Module::has('Cms')) {
            $panel->login();
        }

        $panel = $panel->passwordReset()->sidebarFullyCollapsibleOnDesktop()->spa()->profile(null, true);
=======
        $panel
            ->id('admin')
            ->path('admin');

        if (! Module::has('Cms')) {
            $panel->login();
        }

        $panel = $panel
            ->passwordReset()
            ->sidebarFullyCollapsibleOnDesktop()
            ->spa()
            ->profile(null, true);
>>>>>>> f1d4085 (.)

        app(ApplyMetatagToPanelAction::class)->execute(panel: $panel);

        $panel = $panel
<<<<<<< HEAD
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources',
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages',
            )
=======
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
>>>>>>> f1d4085 (.)
            ->pages([
                MainDashboard::class,
                MyProfilePage::class,
            ])
<<<<<<< HEAD
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets',
            )
=======
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
>>>>>>> f1d4085 (.)
            ->widgets([
                // Widgets\AccountWidget::class,
            ])
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
<<<<<<< HEAD
        $navs = app(GetModulesNavigationItems::class)->execute();
        $panel->navigationItems($navs);
        
        // Temporaneamente disabilitato per debug tenancy
        // $profile_url = MyProfilePage::getUrl(panel: $panel->getId());
        $profile_url = '#';

        $panel->userMenuItems([
            MenuItem::make()
                ->label(__('user::default.profile.my_profile'))
                ->url($profile_url)
=======

        $navs = app(GetModulesNavigationItems::class)->execute();
        $panel->navigationItems($navs);

        try {
            $profile_url = MyProfilePage::getUrl(panel: $panel->getId());
        } catch (Exception $e) {
            $profile_url = '#';
        }

        $panel->userMenuItems([
            MenuItem::make()
                ->url(fn (): string => $profile_url)
>>>>>>> f1d4085 (.)
                ->icon('heroicon-o-user'),
        ]);

        return $panel;
    }
}
