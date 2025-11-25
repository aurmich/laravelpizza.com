<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

use function Safe\preg_replace;

/**
 * Class RouteDynService.
 */
class RouteDynService
{
    private static string $namespace_start = '';

    // Commentato: La proprietà $curr non viene mai letta, quindi potrebbe essere rimossa
    // private static ?string $curr = null;

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    public static function getGroupOpts(array $v, null|string $namespace): array
=======
    public static function getGroupOpts(array $v, ?string $namespace): array
>>>>>>> f1d4085 (.)
    {
        return [
            'prefix' => self::getPrefix($v, $namespace),
            'namespace' => self::getNamespace($v, $namespace),
            'as' => self::getAs($v, $namespace),
        ];
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getPrefix(array $v, null|string $namespace): string
    {
        if (isset($v['prefix'])) {
            Assert::string($prefix = $v['prefix'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getPrefix(array $v, ?string $namespace): string
    {
        if (isset($v['prefix'])) {
            Assert::string($prefix = $v['prefix']);
>>>>>>> f1d4085 (.)

            return $prefix;
        }

<<<<<<< HEAD
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $prefix = mb_strtolower($name);
        $param_name = self::getParamName($v, $namespace);
        if ($param_name !== '') {
            return $prefix . '/{' . $param_name . '}';
=======
        Assert::string($name = $v['name']);
        $prefix = mb_strtolower($name);
        $param_name = self::getParamName($v, $namespace);
        if ($param_name !== '') {
            return $prefix.'/{'.$param_name.'}';
>>>>>>> f1d4085 (.)
        }

        return $prefix;
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getAs(array $v, null|string $_namespace): string
    {
        if (isset($v['as'])) {
            Assert::string($as = $v['as'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getAs(array $v, ?string $namespace): string
    {
        if (isset($v['as'])) {
            Assert::string($as = $v['as']);
>>>>>>> f1d4085 (.)

            return $as;
        }

<<<<<<< HEAD
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
        Assert::string($name = $v['name']);
>>>>>>> f1d4085 (.)
        $as = mb_strtolower($name);
        $as = str_replace('/', '.', $as);
        $as = preg_replace('/{.*}./', '', $as);
        $as = str_replace(['{', '}'], '', $as);

<<<<<<< HEAD
        return $as . '.';
=======
        return $as.'.';
>>>>>>> f1d4085 (.)
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getNamespace(array $v, null|string $namespace): null|string
    {
        if (isset($v['namespace'])) {
            Assert::string($namespace = $v['namespace'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getNamespace(array $v, ?string $namespace): ?string
    {
        if (isset($v['namespace'])) {
            Assert::string($namespace = $v['namespace']);
>>>>>>> f1d4085 (.)

            return $namespace;
        }

<<<<<<< HEAD
        Assert::string($namespace = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
        Assert::string($namespace = $v['name']);
>>>>>>> f1d4085 (.)
        $namespace = str_replace(['{', '}'], '', $namespace);
        if ($namespace === '') {
            return null;
        }

        return Str::studly($namespace);
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getAct(array $v, null|string $_namespace): string
    {
        if (isset($v['act'])) {
            Assert::string($act = $v['act'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getAct(array $v, ?string $namespace): string
    {
        if (isset($v['act'])) {
            Assert::string($act = $v['act']);
>>>>>>> f1d4085 (.)

            return $act;
        }

        Assert::nullOrString($v['act'] = $v['name']);
        Assert::nullOrString($v['act']);
        $v['act'] = preg_replace('/{.*}\//', '', (string) $v['act']);
        if ($v['act'] === null) {
            $v['act'] = '';
        }

        $v['act'] = str_replace('/', '_', $v['act']);
        $v['act'] = Str::camel($v['act']);
        $v['act'] = str_replace(['{', '}'], '', $v['act']);

        return Str::camel($v['act']);
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getParamName(array $v, null|string $_namespace): string
    {
        if (isset($v['param_name'])) {
            Assert::string($param_name = $v['param_name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getParamName(array $v, ?string $namespace): string
    {
        if (isset($v['param_name'])) {
            Assert::string($param_name = $v['param_name']);
>>>>>>> f1d4085 (.)

            return $param_name;
        }

<<<<<<< HEAD
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $param_name = 'id_' . $name;
=======
        Assert::string($name = $v['name']);
        $param_name = 'id_'.$name;
>>>>>>> f1d4085 (.)
        $param_name = str_replace(['{', '}'], '', $param_name);

        return mb_strtolower($param_name);
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<int, string>
     */
<<<<<<< HEAD
    public static function getParamsName(array $v, null|string $namespace): array
=======
    public static function getParamsName(array $v, ?string $namespace): array
>>>>>>> f1d4085 (.)
    {
        $param_name = self::getParamName($v, $namespace);

        return [$param_name];
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    public static function getResourceOpts(array $v, null|string $namespace): array
=======
    public static function getResourceOpts(array $v, ?string $namespace): array
>>>>>>> f1d4085 (.)
    {
        $param_name = self::getParamName($v, $namespace);
        $params_name = self::getParamsName($v, $namespace);
        Assert::isArray($params_name);

        $opts = [
            'parameters' => [mb_strtolower((string) $v['name']) => implode('}/{', $params_name)],
            'names' => self::prefixedResourceNames(self::getAs($v, $namespace)),
        ];

        if (isset($v['only'])) {
            $opts['only'] = $v['only'];
        }

<<<<<<< HEAD
        if ($param_name === '' && !isset($opts['only'])) {
=======
        if ($param_name === '' && ! isset($opts['only'])) {
>>>>>>> f1d4085 (.)
            $opts['only'] = ['index'];
        }

        $opts['where'] = array_fill_keys($params_name, '[0-9]+');

        return $opts;
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getController(array $v, null|string $_namespace): string
    {
        if (isset($v['controller'])) {
            Assert::string($controller = $v['controller'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getController(array $v, ?string $namespace): string
    {
        if (isset($v['controller'])) {
            Assert::string($controller = $v['controller']);
>>>>>>> f1d4085 (.)

            return $controller;
        }

<<<<<<< HEAD
        Assert::string($v['controller'] = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
        Assert::string($v['controller'] = $v['name']);
>>>>>>> f1d4085 (.)
        $v['controller'] = str_replace(['/', '{', '}'], ['_', '', ''], $v['controller']);
        $v['controller'] = Str::studly($v['controller']);
        $v['controller'] .= 'Controller';

        return $v['controller'];
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getUri(array $v, null|string $_namespace): string
    {
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
    public static function getUri(array $v, ?string $namespace): string
    {
        Assert::string($name = $v['name']);
>>>>>>> f1d4085 (.)

        // return mb_strtolower(is_string($v) ? $v : (string) $v['name);
        return $name;
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<int, string>
     */
<<<<<<< HEAD
    public static function getMethod(array $v, null|string $_namespace): array
    {
        if (isset($v['method'])) {
            /** @var array<int, string> */
            return Arr::wrap($v['method']);
=======
    public static function getMethod(array $v, ?string $namespace): array
    {
        if (isset($v['method'])) {
            $wrapped = Arr::wrap($v['method']);
            // Ensure all elements are strings
            /** @var array<int, string> $result */
            $result = [];
            foreach ($wrapped as $item) {
                $result[] = (string) $item;
            }

            return $result;
>>>>>>> f1d4085 (.)
        }

        return ['get', 'post'];
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function getUses(array $v, null|string $namespace): string
=======
    public static function getUses(array $v, ?string $namespace): string
>>>>>>> f1d4085 (.)
    {
        $controller = self::getController($v, $namespace);
        $act = self::getAct($v, $namespace);

<<<<<<< HEAD
        return $controller . '@' . $act;
=======
        return $controller.'@'.$act;
>>>>>>> f1d4085 (.)
    }

    /**
     * @param  array<string, mixed>  $v
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    public static function getCallback(array $v, null|string $namespace, null|string $curr): array
    {
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $as = Str::slug($name);
        $uses = self::getUses($v, $namespace);
        if ($curr !== null) {
            $uses = '\\' . self::$namespace_start . '\\' . $curr . '\\' . $uses;
        } else {
            $uses = '\\' . self::$namespace_start . '\\' . $uses;
=======
    public static function getCallback(array $v, ?string $namespace, ?string $curr): array
    {
        Assert::string($name = $v['name']);
        $as = Str::slug($name);
        $uses = self::getUses($v, $namespace);
        if ($curr !== null) {
            $uses = '\\'.self::$namespace_start.'\\'.$curr.'\\'.$uses;
        } else {
            $uses = '\\'.self::$namespace_start.'\\'.$uses;
>>>>>>> f1d4085 (.)
        }

        return ['as' => $as, 'uses' => $uses];
    }

    /**
     * @param  array<int, array<string, mixed>>  $array
     */
<<<<<<< HEAD
    public static function dynamic_route(
        array $array,
        null|string $namespace = null,
        null|string $namespace_start = null,
        null|string $curr = null,
    ): void {
=======
    public static function dynamic_route(array $array, ?string $namespace = null, ?string $namespace_start = null, ?string $curr = null): void
    {
>>>>>>> f1d4085 (.)
        Assert::isArray($array, 'The $array parameter must be an array.');
        Assert::notEmpty($array, 'The $array parameter cannot be empty.');

        if ($namespace_start !== null) {
            self::$namespace_start = $namespace_start;
        }

        foreach ($array as $v) {
            Assert::isArray($v, 'Each item in the array must be an array.');
            $group_opts = self::getGroupOpts($v, $namespace);
            $v['group_opts'] = $group_opts;

            self::createRouteResource($v, $namespace);

            Route::group($group_opts, static function () use ($v, $namespace, $curr): void {
                self::createRouteActs($v, $namespace, $curr);
                self::createRouteSubs($v, $namespace, $curr);
            });
        }
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function createRouteResource(array $v, null|string $namespace): void
=======
    public static function createRouteResource(array $v, ?string $namespace): void
>>>>>>> f1d4085 (.)
    {
        if ($v['name'] === null) {
            return;
        }
<<<<<<< HEAD
        Assert::string($name = $v['name'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
        Assert::string($name = $v['name']);
>>>>>>> f1d4085 (.)
        $opts = self::getResourceOpts($v, $namespace);
        $controller = self::getController($v, $namespace);

        Route::resource($name, $controller, $opts);
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function createRouteSubs(array $v, null|string $namespace, null|string $curr): void
    {
        if (!isset($v['subs'])) {
=======
    public static function createRouteSubs(array $v, ?string $namespace, ?string $curr): void
    {
        if (! isset($v['subs'])) {
>>>>>>> f1d4085 (.)
            return;
        }

        $sub_namespace = self::getNamespace($v, $namespace);
        $curr = $curr === null ? $sub_namespace : $curr;
        Assert::isArray($subs = $v['subs']);
<<<<<<< HEAD
        /** @var array<int, array<string, mixed>> $subs */
        self::dynamic_route($subs, $sub_namespace, null, $curr);
=======

        // Ensure subs is properly typed for dynamic_route
        /** @var array<int, array<string, mixed>> $typedSubs */
        $typedSubs = [];
        foreach ($subs as $index => $sub) {
            if (is_array($sub)) {
                /** @var array<string, mixed> $typedSub */
                $typedSub = [];
                foreach ($sub as $key => $value) {
                    $typedSub[(string) $key] = $value;
                }
                $typedSubs[(int) $index] = $typedSub;
            }
        }

        self::dynamic_route($typedSubs, $sub_namespace, null, $curr);
>>>>>>> f1d4085 (.)
    }

    /**
     * @param  array<string, mixed>  $v
     */
<<<<<<< HEAD
    public static function createRouteActs(array $v, null|string $namespace, null|string $curr): void
    {
        if (!isset($v['acts']) || !is_array($v['acts'])) {
=======
    public static function createRouteActs(array $v, ?string $namespace, ?string $curr): void
    {
        if (! isset($v['acts']) || ! is_array($v['acts'])) {
>>>>>>> f1d4085 (.)
            return;
        }

        $controller = self::getController($v, $namespace);
        foreach ($v['acts'] as $v1) {
            Assert::isArray($v1);
<<<<<<< HEAD
            /** @var array<string, mixed> $v1 */
            $v1['controller'] = $controller;

            $method = self::getMethod($v1, $namespace);
            $uri = self::getUri($v1, $namespace);
            $callback = self::getCallback($v1, $namespace, $curr);
=======

            // Ensure $v1 is properly typed
            /** @var array<string, mixed> $typedV1 */
            $typedV1 = [];
            foreach ($v1 as $key => $value) {
                $typedV1[(string) $key] = $value;
            }
            $typedV1['controller'] = $controller;

            $method = self::getMethod($typedV1, $namespace);
            $uri = self::getUri($typedV1, $namespace);
            $callback = self::getCallback($typedV1, $namespace, $curr);
>>>>>>> f1d4085 (.)
            Route::match($method, $uri, $callback);
        }
    }

    /**
     * @return array<string, string>
     */
    public static function prefixedResourceNames(string $prefix): array
    {
        if (mb_substr($prefix, -1) === '.') {
            $prefix = mb_substr($prefix, 0, -1);
        }

        return [
<<<<<<< HEAD
            'index' => $prefix . '.index',
            'create' => $prefix . '.create',
            'store' => $prefix . '.store',
            'show' => $prefix . '.show',
            'edit' => $prefix . '.edit',
            'update' => $prefix . '.update',
            'destroy' => $prefix . '.destroy',
=======
            'index' => $prefix.'.index',
            'create' => $prefix.'.create',
            'store' => $prefix.'.store',
            'show' => $prefix.'.show',
            'edit' => $prefix.'.edit',
            'update' => $prefix.'.update',
            'destroy' => $prefix.'.destroy',
>>>>>>> f1d4085 (.)
        ];
    }

    // --------------------------------------------------
}
