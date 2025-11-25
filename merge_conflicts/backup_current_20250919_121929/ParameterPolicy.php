<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\Job\Models\Parameter;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> e1b0bf9 (.)

class ParameterPolicy extends JobBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('parameter.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('parameter.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Parameter $_parameter): bool
    {
        return $user->hasPermissionTo('parameter.view');
=======
    public function view(ProfileContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('parameter.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('parameter.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Parameter $_parameter): bool
    {
        return $user->hasPermissionTo('parameter.update');
=======
    public function update(ProfileContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Parameter $_parameter): bool
    {
        return $user->hasPermissionTo('parameter.delete');
=======
    public function delete(ProfileContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Parameter $_parameter): bool
    {
        return $user->hasPermissionTo('parameter.restore');
=======
    public function restore(ProfileContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Parameter $parameter): bool
    {
        return $user->hasPermissionTo('parameter.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }
}
