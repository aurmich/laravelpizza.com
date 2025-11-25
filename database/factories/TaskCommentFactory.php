<?php

declare(strict_types=1);

namespace Modules\Job\Database\Factories;

use Modules\Job\Models\TaskComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = TaskComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
