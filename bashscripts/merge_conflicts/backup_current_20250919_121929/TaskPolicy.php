<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\Job\Models\Task;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> e1b0bf9 (.)

class TaskPolicy extends JobBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('task.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('task.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Task $_task): bool
    {
        return $user->hasPermissionTo('task.view');
=======
    public function view(ProfileContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('task.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('task.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Task $_task): bool
    {
        return $user->hasPermissionTo('task.update');
=======
    public function update(ProfileContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Task $_task): bool
    {
        return $user->hasPermissionTo('task.delete');
=======
    public function delete(ProfileContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Task $_task): bool
    {
        return $user->hasPermissionTo('task.restore');
=======
    public function restore(ProfileContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Task $task): bool
    {
        return $user->hasPermissionTo('task.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }
}
