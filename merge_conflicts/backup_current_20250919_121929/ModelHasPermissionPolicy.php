<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\ModelHasPermission;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\User\Contracts\UserContract;
use Modules\User\Models\ModelHasPermission;
>>>>>>> fbc8f8e (.)

class ModelHasPermissionPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-permission.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, ModelHasPermission $_modelHasPermission): bool
    {
        return $user->hasPermissionTo('model-has-permission.view') || $user->hasRole('super-admin');
=======
    public function view(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('model-has-permission.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, ModelHasPermission $_modelHasPermission): bool
    {
        return $user->hasPermissionTo('model-has-permission.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, ModelHasPermission $_modelHasPermission): bool
    {
        return $user->hasPermissionTo('model-has-permission.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, ModelHasPermission $_modelHasPermission): bool
    {
        return $user->hasPermissionTo('model-has-permission.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, ModelHasPermission $modelHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('model-has-permission.force-delete') || $user->hasRole('super-admin');
=======
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
