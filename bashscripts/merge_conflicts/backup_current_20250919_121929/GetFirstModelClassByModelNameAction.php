<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetFirstModelClassByModelNameAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $modelName): string
    {
        $models = app(GetAllModelsAction::class)->execute();
<<<<<<< HEAD
        Assert::string(
            $modelClass = collect($models)->get($modelName),
            '[' . __LINE__ . '][' . class_basename($this) . ']',
        );
=======
        Assert::string($modelClass = collect($models)->get($modelName), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> f1d4085 (.)

        return $modelClass;
    }
}
