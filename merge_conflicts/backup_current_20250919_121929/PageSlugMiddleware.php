<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> 3401a6b (.)
namespace Modules\Cms\Http\Middleware;

use Illuminate\Contracts\Http\Kernel;
use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Modules\Cms\Models\Page;
use Symfony\Component\HttpFoundation\Response;
=======
use Symfony\Component\HttpFoundation\Response;
use Modules\Cms\Models\Page;
>>>>>>> 3401a6b (.)

class PageSlugMiddleware
{
    protected Kernel $kernel;
<<<<<<< HEAD

    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');

=======
    
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');
        
        
>>>>>>> 3401a6b (.)
        // Handle case where slug might be null
        if (!$slug) {
            return $next($request);
        }

<<<<<<< HEAD
        $middlewares = Page::getMiddlewareBySlug($slug);
=======
        $middlewares = Page::getMiddlewareBySlug($slug); 
>>>>>>> 3401a6b (.)
        // Should return ["auth", "Modules\User\Http\Middleware\EnsureUserHasType:doctor"]

        if (empty($middlewares)) {
            return $next($request);
        }
        $this->kernel = app(Kernel::class);
        // Execute middlewares manually in a chain
        return $this->executeMiddlewareChain($request, $middlewares, $next);
    }

    /**
     * Parse a middleware string to get the name and parameters.
     *
     * @param  string  $middleware
     * @return array
     */
    protected function parseMiddleware($middleware)
    {
        [$name, $parameters] = array_pad(explode(':', $middleware, 2), 2, []);

        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }

        return [$name, $parameters];
    }

<<<<<<< HEAD
=======
    
>>>>>>> 3401a6b (.)
    /**
     * Execute middleware chain manually
     */
    protected function executeMiddlewareChain(Request $request, array $middlewares, Closure $finalNext): Response
    {
        if (empty($middlewares)) {
            return $finalNext($request);
        }
<<<<<<< HEAD

        $middleware = array_shift($middlewares);

        [$middlewareClass, $parameters] = $this->parseMiddleware($middleware);

=======
        
        $middleware = array_shift($middlewares);
       
       
        [$middlewareClass, $parameters]=$this->parseMiddleware($middleware);
        
>>>>>>> 3401a6b (.)
        // Resolve middleware class name if it's an alias
        $middlewareClass = $this->resolveMiddlewareClass($middlewareClass);
        // Create middleware instance
        $middlewareInstance = app($middlewareClass);
<<<<<<< HEAD

        // Create next closure for remaining middlewares
        $next = fn ($request) => $this->executeMiddlewareChain($request, $middlewares, $finalNext);

=======
        
        
        // Create next closure for remaining middlewares
        $next = function ($request) use ($middlewares, $finalNext) {
            return $this->executeMiddlewareChain($request, $middlewares, $finalNext);
        };
        
>>>>>>> 3401a6b (.)
        // Execute current middleware
        if (empty($parameters)) {
            return $middlewareInstance->handle($request, $next);
        } else {
            return $middlewareInstance->handle($request, $next, ...$parameters);
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 3401a6b (.)
    /**
     * Resolve middleware class name from alias
     */
    protected function resolveMiddlewareClass(string $middleware): string
    {
<<<<<<< HEAD
        // Get middleware aliases from HTTP kernel
        // $kernel = app(\Illuminate\Contracts\Http\Kernel::class);

        // Try to get from route middleware (custom middleware)

=======
        
        
        // Get middleware aliases from HTTP kernel
       // $kernel = app(\Illuminate\Contracts\Http\Kernel::class);
        
        // Try to get from route middleware (custom middleware)
        
>>>>>>> 3401a6b (.)
        $routeMiddleware = $this->kernel->getRouteMiddleware();
        if (isset($routeMiddleware[$middleware])) {
            return $routeMiddleware[$middleware];
        }
<<<<<<< HEAD

        // If not an alias, return as-is (assuming it's a full class name)
        return $middleware;
    }
}
=======
        
        
       
        
        // If not an alias, return as-is (assuming it's a full class name)
        return $middleware;
    }
}
>>>>>>> 3401a6b (.)
