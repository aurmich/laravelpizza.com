<?php

/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class GetModelFieldsByModelAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(Model $model): array
    {
<<<<<<< HEAD
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
=======
        return $model->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($model->getTable());
>>>>>>> f1d4085 (.)
    }
}
