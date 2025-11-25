<?php

declare(strict_types=1);

namespace Modules\User\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PasswordExpiryMiddleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if ($request->routeIs('password.change') || $request->routeIs('password.update')) {
            return $next($request);
        }

        if ($request->routeIs($this->getPasswordExpiryRoute()) || $request->routeIs('*.auth.*')) {
            return $next($request);
        }

        if ($this->passwordHasExpired()) {
            return redirect(route($this->getPasswordExpiryRoute()));
        }

        return $next($request);
    }

    public function getPasswordExpiryRoute(): string
    {
        return 'errors.password-expired';
<<<<<<< HEAD

        /*
         * $route = Filament::getCurrentPanel()->generateRouteName(
         * // config('password-expiry.password_expiry_route')
         * // 'password-expiry.reset-password'
         * // 'password.expired'
         * 'pages.password-expired'
         * ) ?? '#';
         *
         * return $route;
         * // */
=======
        /*
        $route = Filament::getCurrentPanel()->generateRouteName(
            // config('password-expiry.password_expiry_route')
            // 'password-expiry.reset-password'
            // 'password.expired'
            'pages.password-expired'
        ) ?? '#';

        return $route;
        // */
>>>>>>> fbc8f8e (.)
        // return 'filament.admin.auth.password-reset.request';
    }

    protected function passwordHasExpired(): bool
    {
        $user = Auth::user();
<<<<<<< HEAD
        if (!$user) {
=======
        if (! $user) {
>>>>>>> fbc8f8e (.)
            return false;
        }

        if ($user->is_otp) {
            return true;
        }
        if (blank($user->password)) {
            return false;
        }

        if (blank($user->password_expires_at)) {
            return false;
        }

        if (now()->isAfter($user->password_expires_at)) {
            return true;
        }

        return false;
    }
}
