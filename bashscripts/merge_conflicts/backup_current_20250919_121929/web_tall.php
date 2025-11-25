<?php

/**
 * routes from laravel preset Tall.
 */

declare(strict_types=1);

use Modules\User\Http\Livewire\Auth\Passwords\Email;
use Modules\User\Http\Livewire\Auth\Passwords\Reset;
use Modules\User\Http\Livewire\Auth\Verify;
use Modules\User\Http\Livewire\Auth\Passwords\Confirm;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Auth\EmailVerificationController;
use Modules\User\Http\Controllers\Auth\LogoutController;
use Modules\User\Http\Livewire\Auth\Register;

/*
<<<<<<< HEAD
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
=======
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
>>>>>>> fbc8f8e (.)

// Route::view('/', 'welcome')->name('home');
Route::prefix('{lang}')->group(function () {
    Route::middleware('guest')
        ->namespace('\Modules\User\Http\Livewire\Auth')
        ->group(static function (): void {
<<<<<<< HEAD
            Route::get('login', 'Login')->name('login');

            Route::get('register', Register::class)->name('register');
        });

    Route::middleware([])->namespace('\Modules\User\Http\Livewire\Auth')->group(static function (): void {
        Route::get('password/reset', Email::class)->name('password.request');

        Route::get('password/reset/{token}', Reset::class)->name(
            'password.reset',
        );
    });
=======
            Route::get('login', 'Login')
                ->name('login');

            Route::get('register', Register::class)
                ->name('register');
        });

    Route::middleware([])
        ->namespace('\Modules\User\Http\Livewire\Auth')
        ->group(static function (): void {
            Route::get('password/reset', Email::class)
                ->name('password.request');

            Route::get('password/reset/{token}', Reset::class)
                ->name('password.reset');
        });
>>>>>>> fbc8f8e (.)

    Route::middleware('auth')
        ->namespace('\Modules\User\Http\Livewire\Auth')
        ->group(static function (): void {
            Route::get('email/verify', Verify::class)
                ->middleware('throttle:6,1')
                ->name('verification.notice');

<<<<<<< HEAD
            Route::get('password/confirm', Confirm::class)->name(
                'password.confirm',
            );
        });

    Route::middleware('auth')
        // ->namespace('\Modules\User\Http\Livewire\Auth')
=======
            Route::get('password/confirm', Confirm::class)
                ->name('password.confirm');
        });

    Route::middleware('auth')
    // ->namespace('\Modules\User\Http\Livewire\Auth')
>>>>>>> fbc8f8e (.)
        ->group(static function (): void {
            Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
                ->middleware('signed')
                ->name('verification.verify');

<<<<<<< HEAD
            Route::match(['get', 'post'], 'logout', LogoutController::class)->name('logout');
=======
            Route::match(['get', 'post'], 'logout', LogoutController::class)
                ->name('logout');
>>>>>>> fbc8f8e (.)
        });
})->whereIn('lang', ['it', 'en']);

Route::namespace('Socialite')
    ->name('socialite.')
<<<<<<< HEAD
    ->group(static function (): void {
        Route::get(
            '/login/{provider}',
            'RedirectToProviderController',
        // 'LoginController@redirectToProvider',
        );
        // ->name('oauth.redirect')

        Route::get('/sso/{provider}/callback', 'ProcessCallbackController');

        // ->name('oauth.callback');
    });
=======
    ->group(
        static function (): void {
            Route::get(
                '/login/{provider}',
                'RedirectToProviderController',
                // 'LoginController@redirectToProvider',
            );
            // ->name('oauth.redirect')

            Route::get(
                '/sso/{provider}/callback',
                'ProcessCallbackController',
            );
            // ->name('oauth.callback');
        }
    );
>>>>>>> fbc8f8e (.)
