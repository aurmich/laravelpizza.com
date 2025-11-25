<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\RoleHasPermission;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\User\Contracts\UserContract;
use Modules\User\Models\RoleHasPermission;
>>>>>>> fbc8f8e (.)

class RoleHasPermissionPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('role-has-permission.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, RoleHasPermission $_roleHasPermission): bool
    {
        return $user->hasPermissionTo('role-has-permission.view') || $user->hasRole('super-admin');
=======
    public function view(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('role-has-permission.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, RoleHasPermission $_roleHasPermission): bool
    {
        return $user->hasPermissionTo('role-has-permission.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, RoleHasPermission $_roleHasPermission): bool
    {
        return $user->hasPermissionTo('role-has-permission.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, RoleHasPermission $_roleHasPermission): bool
    {
        return $user->hasPermissionTo('role-has-permission.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, RoleHasPermission $roleHasPermission): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('role-has-permission.force-delete') || $user->hasRole('super-admin');
=======
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
