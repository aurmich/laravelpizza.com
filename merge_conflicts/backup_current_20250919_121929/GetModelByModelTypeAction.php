<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Xot\Actions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetModelByModelTypeAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
<<<<<<< HEAD
    public function execute(string $model_type, null|string $model_id): Model
=======
    public function execute(string $model_type, ?string $model_id): Model
>>>>>>> f1d4085 (.)
    {
        $model_class = app(GetModelClassByModelTypeAction::class)->execute($model_type);
        Assert::isInstanceOf($model = app($model_class), Model::class);
        if (null !== $model_id) {
            $model = $model->find($model_id);
        }

        if (null === $model) {
<<<<<<< HEAD
            throw new Exception('[' . __LINE__ . '][' . class_basename($this) . ']');
=======
            throw new Exception('['.__LINE__.']['.class_basename($this).']');
>>>>>>> f1d4085 (.)
        }

        return $model;
    }
}
