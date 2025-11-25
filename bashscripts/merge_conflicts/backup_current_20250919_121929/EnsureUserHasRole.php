<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> fbc8f8e (.)
namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

<<<<<<< HEAD
/**
 * Route::put('/post/{id}', function (string $id) {
 *   // ...
 * })->middleware(EnsureUserHasRole::class.':editor');
 * Route::put('/post/{id}', function (string $id) {
 *     // ...
 *})->middleware(EnsureUserHasRole::class.':editor,publisher');
 */
=======
/** 
* Route::put('/post/{id}', function (string $id) {
*   // ...
* })->middleware(EnsureUserHasRole::class.':editor');
* Route::put('/post/{id}', function (string $id) {
*     // ...
*})->middleware(EnsureUserHasRole::class.':editor,publisher');
*/
>>>>>>> fbc8f8e (.)

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request):Response $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
<<<<<<< HEAD
        $user = $request->user();
        // Check if user has role using Spatie Permission's hasRole method
        if (!$user || !method_exists($user, 'hasRole') || !$user->hasRole($role)) {
=======
        if (! $request->user()?->hasRole($role)) {
>>>>>>> fbc8f8e (.)
            // Redirect...
            return redirect()->route('home');
        }

        return $next($request);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> fbc8f8e (.)
