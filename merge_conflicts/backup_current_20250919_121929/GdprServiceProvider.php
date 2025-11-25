<?php

declare(strict_types=1);

namespace Modules\Gdpr\Providers;

<<<<<<< HEAD
use Override;
use Statikbe\CookieConsent\CookieConsentMiddleware;
use Illuminate\Routing\Router;
use Modules\Gdpr\Datas\GdprData;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;
use Modules\Xot\Providers\XotBaseServiceProvider;
=======
use Statikbe\CookieConsent\CookieConsentMiddleware;
use Illuminate\Routing\Router;
use Modules\Gdpr\Datas\GdprData;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;
>>>>>>> 0c1819a (.)

class GdprServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Gdpr';
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0c1819a (.)
    public function boot(): void
    {
        parent::boot();

        $lang_path = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'lang');
        $this->loadTranslationsFrom($lang_path, 'cookie-consent');
<<<<<<< HEAD

=======
        
>>>>>>> 0c1819a (.)
        $router = app('router');
        $this->registerMyMiddleware($router);
    }

    public function registerMyMiddleware(Router $router): void
    {
<<<<<<< HEAD
        $gdpr = GdprData::make();
        if ($gdpr->cookie_banner_enabled) {
=======
        $gdpr=GdprData::make();
        if($gdpr->cookie_banner_enabled){
>>>>>>> 0c1819a (.)
            $router->pushMiddlewareToGroup('web', CookieConsentMiddleware::class);
        }
    }

<<<<<<< HEAD
    
=======
    public function register(): void
    {
        parent::register();
    }
>>>>>>> 0c1819a (.)
}
