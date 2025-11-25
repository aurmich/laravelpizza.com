<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Module;

use Exception;
use Error;
use Illuminate\Support\Facades\Config;
use Webmozart\Assert\Assert;

class GetModulePathByGeneratorAction
{
    public function execute(string $moduleName, string $generatorPath): string
    {
<<<<<<< HEAD
        $relativePath = Config::string('modules.paths.generator.' . $generatorPath . '.path');
        try {
            $res = module_path($moduleName, $relativePath);
        } catch (Exception|Error $e) {
            throw new Exception('Module path not found: 
            name:[' .
            $moduleName .
            '] 
            generatorPath:[' .
            $generatorPath .
            ']
            error_message:[' .
            $e->getMessage() .
                ']');
        }
        Assert::string($res, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
=======
        $relativePath = Config::string('modules.paths.generator.'.$generatorPath.'.path');
        try {
            $res = module_path($moduleName, $relativePath);
        } catch (Exception|Error $e) {
            throw new Exception('Module path not found: '.$moduleName.' '.$generatorPath);
        }
        Assert::string($res);
>>>>>>> f1d4085 (.)

        return $res;
    }
}
