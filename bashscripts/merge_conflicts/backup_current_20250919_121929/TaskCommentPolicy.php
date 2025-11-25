<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\Job\Models\TaskComment;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> e1b0bf9 (.)

class TaskCommentPolicy extends JobBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('task_comment.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('task_comment.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, TaskComment $_task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.view');
=======
    public function view(ProfileContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('task_comment.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('task_comment.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, TaskComment $_task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.update');
=======
    public function update(ProfileContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, TaskComment $_task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.delete');
=======
    public function delete(ProfileContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, TaskComment $_task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.restore');
=======
    public function restore(ProfileContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.forceDelete');
=======
    public function forceDelete(ProfileContract $user, TaskComment $task_comment): bool
    {
        return $user->hasPermissionTo('task_comment.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }
}
