<?php

declare(strict_types=1);

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\GeneratorCommand;

use function Safe\realpath;

class GenerateModelClassCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xot:generate-model-class {model_class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new ModelClass.';

    protected function getStub()
    {
<<<<<<< HEAD
        return realpath(__DIR__ . '/../stubs/model.stub');
=======
        return realpath(__DIR__.'/../stubs/model.stub');
>>>>>>> f1d4085 (.)
    }

    protected function getDefaultNamespace($rootNamespace)
    {
<<<<<<< HEAD
        return $rootNamespace . '\Models';
=======
        return $rootNamespace.'\Models';
>>>>>>> f1d4085 (.)
    }

    protected function replaceClass($stub, $name)
    {
<<<<<<< HEAD
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
=======
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
>>>>>>> f1d4085 (.)

        // Do string replacement
        return str_replace('{{service_name}}', $class, $stub);
    }
}
