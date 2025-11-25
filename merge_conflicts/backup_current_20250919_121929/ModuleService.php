<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use stdClass;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;
use ReflectionClass;

// ----------- Requests ----------

/**
 * Class ModuleService.
 */
class ModuleService
{
    public string $name;

<<<<<<< HEAD
    private static null|self $_instance = null;
=======
    private static ?self $_instance = null;
>>>>>>> f1d4085 (.)

    /**
     * getInstance.
     *
     * this method will return instance of the class
     */
    public static function getInstance(): self
    {
<<<<<<< HEAD
        if (!(self::$_instance instanceof self)) {
=======
        if (! self::$_instance instanceof self) {
>>>>>>> f1d4085 (.)
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Undocumented function.
     */
    public static function make(): self
    {
        return static::getInstance();
    }

    /**
     * Undocumented function.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get models for the module.
     *
     * @return array<string, class-string>
     */
    public function getModels(): array
    {
        /*
<<<<<<< HEAD
         * if (null == $module) {
         * return [];
         * }
         */
        $mod = Module::find($this->name);
        if (!($mod instanceof \Nwidart\Modules\Module)) {
            return [];
        }

        $mod_path = $mod->getPath() . '/Models';
=======
        if (null == $module) {
            return [];
        }
        */
        $mod = Module::find($this->name);
        if (! $mod instanceof \Nwidart\Modules\Module) {
            return [];
        }

        $mod_path = $mod->getPath().'/Models';
>>>>>>> f1d4085 (.)
        $mod_path = str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $mod_path);

        $files = File::files($mod_path);
        $data = [];
<<<<<<< HEAD
        $ns = 'Modules\\' . $mod->getName() . '\\Models'; // con la barra davanti non va il search ?
=======
        $ns = 'Modules\\'.$mod->getName().'\\Models';  // con la barra davanti non va il search ?
>>>>>>> f1d4085 (.)
        foreach ($files as $file) {
            $filename = $file->getRelativePathname();
            $ext = '.php';
            // dddx(['ext' => $file->getExtension(), get_class_methods($file)]);
            if (Str::endsWith($filename, $ext)) {
                $tmp = new stdClass();

                $name = mb_substr($filename, 0, -mb_strlen($ext));

<<<<<<< HEAD
                /**
                 * @var class-string
                 */
                $class = $ns . '\\' . $name;
=======
                
                /**
                 * @var class-string
                 */
                $class = $ns.'\\'.$name;
>>>>>>> f1d4085 (.)
                //Strict comparison using === between stdClass and null will always evaluate to false.

                //if ($tmp === null) {
                //    continue;
                //}
                $tmp->class = $class;
                $name = Str::snake($name);
                $tmp->name = $name;

                try {
                    $reflection_class = new ReflectionClass($tmp->class);
<<<<<<< HEAD
                    if (!$reflection_class->isAbstract()) {
=======
                    if (! $reflection_class->isAbstract()) {
>>>>>>> f1d4085 (.)
                        $data[$tmp->name] = $tmp->class;
                    }
                } catch (Exception) {
                    // Ignore reflection errors
                }
            }
        }

        return $data;
    }
}
