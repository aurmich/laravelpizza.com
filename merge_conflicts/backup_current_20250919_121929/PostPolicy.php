<?php

declare(strict_types=1);

namespace Modules\Lang\Models\Policies;

use Modules\Lang\Models\Post;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> 8b0b6ac (.)

class PostPolicy extends LangBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('post.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('post.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Post $_post): bool
    {
        return $user->hasPermissionTo('post.view');
=======
    public function view(ProfileContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('post.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('post.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Post $_post): bool
    {
        return $user->hasPermissionTo('post.update');
=======
    public function update(ProfileContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Post $_post): bool
    {
        return $user->hasPermissionTo('post.delete');
=======
    public function delete(ProfileContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Post $_post): bool
    {
        return $user->hasPermissionTo('post.restore');
=======
    public function restore(ProfileContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Post $post): bool
    {
        return $user->hasPermissionTo('post.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> 8b0b6ac (.)
    }
}
