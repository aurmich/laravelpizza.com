<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\File;

use Nwidart\Modules\Facades\Module;
use Spatie\QueueableAction\QueueableAction;

class AssetPathAction
{
    use QueueableAction;

    public function execute(string $asset): string
    {
<<<<<<< HEAD
        [$ns, $file] = explode('::', $asset);
        $module_path = Module::getModulePath($ns) . 'resources';

        return $module_path . '/' . $file;
=======
        [$ns,$file] = explode('::', $asset);
        $module_path = Module::getModulePath($ns).'resources';

        return $module_path.'/'.$file;
>>>>>>> f1d4085 (.)
    }
}
