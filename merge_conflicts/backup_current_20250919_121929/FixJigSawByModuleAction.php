<?php

declare(strict_types=1);

namespace Modules\Cms\Actions\Module;

use Modules\Xot\Actions\File\FixPathAction;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Laravel\Module;
<<<<<<< HEAD
use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\Finder\SplFileInfo;

use function Safe\realpath;

=======

use function Safe\realpath;

use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\Finder\SplFileInfo;

>>>>>>> 3401a6b (.)
final class FixJigSawByModuleAction
{
    use QueueableAction;

    public function execute(Module $module): array
    {
        $res = [];
<<<<<<< HEAD
        $stubs_dir = realpath(__DIR__ . '/../../Console/Commands/stubs/docs');
=======
        $stubs_dir = realpath(__DIR__.'/../../Console/Commands/stubs/docs');
>>>>>>> 3401a6b (.)
        // if ($stubs_dir === false) {
        //    throw new Exception('['.__LINE__.']['.__FILE__.']');
        // }

        $stubs = File::allFiles($stubs_dir);
        foreach ($stubs as $stub) {
<<<<<<< HEAD
            if (!$stub->isFile()) {
=======
            if (! $stub->isFile()) {
>>>>>>> 3401a6b (.)
                continue;
            }

            if ('stub' !== $stub->getExtension()) {
                continue;
            }

            $res[] = $this->publish($stub, $module);
        }

        return $res;
    }

    public function publish(SplFileInfo $stub, Module $module): string
    {
        $filename = str_replace('.stub', '', $stub->getRelativePathname());
<<<<<<< HEAD
        $file_path = $module->getPath() . '/docs/' . $filename;
        $file_path = app(FixPathAction::class)->execute($file_path);
        /*
         * //mkdir(): Permission denied
         * if (! is_dir(dirname($file_path))) {
         * (new Filesystem())->makeDirectory(dirname($file_path));
         * }
         */
=======
        $file_path = $module->getPath().'/docs/'.$filename;
        $file_path = app(FixPathAction::class)->execute($file_path);
        /*
        //mkdir(): Permission denied
        if (! is_dir(dirname($file_path))) {
            (new Filesystem())->makeDirectory(dirname($file_path));
        }
        */
>>>>>>> 3401a6b (.)

        $replace = [
            'ModuleName' => $module->getName(),
        ];

<<<<<<< HEAD
        $file_content = str_replace(array_keys($replace), array_values($replace), $stub->getContents());
=======
        $file_content = str_replace(
            array_keys($replace),
            array_values($replace),
            $stub->getContents(),
        );
>>>>>>> 3401a6b (.)
        File::put($file_path, $file_content);

        return $file_path;
    }
}
