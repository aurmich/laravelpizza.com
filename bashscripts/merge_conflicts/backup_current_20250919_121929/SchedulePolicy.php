<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\Job\Models\Schedule;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> e1b0bf9 (.)

class SchedulePolicy extends JobBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('schedule.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('schedule.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Schedule $_schedule): bool
    {
        return $user->hasPermissionTo('schedule.view');
=======
    public function view(ProfileContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('schedule.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('schedule.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Schedule $_schedule): bool
    {
        return $user->hasPermissionTo('schedule.update');
=======
    public function update(ProfileContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Schedule $_schedule): bool
    {
        return $user->hasPermissionTo('schedule.delete');
=======
    public function delete(ProfileContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Schedule $_schedule): bool
    {
        return $user->hasPermissionTo('schedule.restore');
=======
    public function restore(ProfileContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Schedule $schedule): bool
    {
        return $user->hasPermissionTo('schedule.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> e1b0bf9 (.)
    }
}
