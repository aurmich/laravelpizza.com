<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\Feature;
use Modules\Xot\Contracts\UserContract;
=======

>>>>>>> fbc8f8e (.)

class FeaturePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('feature.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Feature $_feature): bool
    {
        return $user->hasPermissionTo('feature.view') || $user->hasRole('super-admin');
=======
    public function view(UserContract $user, Feature $feature): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('feature.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Feature $_feature): bool
    {
        return $user->hasPermissionTo('feature.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, Feature $feature): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Feature $_feature): bool
    {
        return $user->hasPermissionTo('feature.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, Feature $feature): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Feature $_feature): bool
    {
        return $user->hasPermissionTo('feature.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, Feature $feature): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, Feature $feature): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('feature.force-delete') || $user->hasRole('super-admin');
=======

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
