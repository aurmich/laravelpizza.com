<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

<<<<<<< HEAD
use Override;
=======
>>>>>>> f1d4085 (.)
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Feed;

class FeedPolicy extends XotBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('feed.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Feed $_feed): bool
=======
    public function view(UserContract $user, Feed $feed): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('feed.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('feed.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Feed $_feed): bool
=======
    public function update(UserContract $user, Feed $feed): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('feed.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Feed $_feed): bool
=======
    public function delete(UserContract $user, Feed $feed): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('feed.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Feed $_feed): bool
=======
    public function restore(UserContract $user, Feed $feed): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('feed.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Feed $feed): bool
    {
        return $user->hasPermissionTo('feed.forceDelete');
    }
}
