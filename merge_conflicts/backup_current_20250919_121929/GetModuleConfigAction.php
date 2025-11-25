<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Module;

use Exception;
<<<<<<< HEAD
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
=======
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
>>>>>>> f1d4085 (.)
use Spatie\QueueableAction\QueueableAction;

class GetModuleConfigAction
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(string $moduleName, string $config): array
    {
        $configPath = app(GetModulePathByGeneratorAction::class)->execute($moduleName, 'config');
        $configFile = $configPath . '/' . $config . '.php';
        if (!file_exists($configFile)) {
            throw new Exception('Config file not found: ' . $configFile);
=======
    public function execute(string $moduleName,string $config): array
    {
        $configPath = app(GetModulePathByGeneratorAction::class)->execute($moduleName, 'config');
        $configFile=$configPath.'/'.$config.'.php';
        if(!file_exists($configFile)){
            throw new Exception('Config file not found: '.$configFile);
>>>>>>> f1d4085 (.)
        }
        dddx(File::getRequire($configFile));
        return [];
    }
}
