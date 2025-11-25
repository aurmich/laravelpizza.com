<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\Job\Models\Export;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> e1b0bf9 (.)

class ExportPolicy extends JobBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('export.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('export.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Export $_export): bool
    {
        return $user->hasPermissionTo('export.view');
=======
    public function view(ProfileContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('export.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('export.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Export $_export): bool
    {
        return $user->hasPermissionTo('export.update');
=======
    public function update(ProfileContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Export $_export): bool
    {
        return $user->hasPermissionTo('export.delete');
=======
    public function delete(ProfileContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Export $_export): bool
    {
        return $user->hasPermissionTo('export.restore');
=======
    public function restore(ProfileContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Export $export): bool
    {
        return $user->hasPermissionTo('export.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }
}
