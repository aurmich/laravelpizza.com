<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\DeviceProfile;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\User\Contracts\UserContract;
use Modules\User\Models\DeviceProfile;
>>>>>>> fbc8f8e (.)

class DeviceProfilePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('device-profile.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, DeviceProfile $deviceProfile): bool
    {
<<<<<<< HEAD
        return (
            $user->hasPermissionTo('device-profile.view') ||
            $user->id === $deviceProfile->user_id ||
            $user->hasRole('super-admin')
        );
=======
        return $user->id === $deviceProfile->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('device-profile.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, DeviceProfile $_deviceProfile): bool
    {
        return $user->hasPermissionTo('device-profile.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, DeviceProfile $deviceProfile): bool
    {
        return $user->id === $deviceProfile->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, DeviceProfile $_deviceProfile): bool
    {
        return $user->hasPermissionTo('device-profile.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, DeviceProfile $deviceProfile): bool
    {
        return $user->id === $deviceProfile->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, DeviceProfile $_deviceProfile): bool
    {
        return $user->hasPermissionTo('device-profile.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, DeviceProfile $deviceProfile): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, DeviceProfile $deviceProfile): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('device-profile.force-delete') || $user->hasRole('super-admin');
=======
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
