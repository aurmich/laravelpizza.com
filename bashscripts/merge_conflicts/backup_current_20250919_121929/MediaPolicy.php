<?php

declare(strict_types=1);

namespace Modules\Media\Models\Policies;

use Modules\Media\Models\Media;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> 0a466ed (.)

class MediaPolicy extends MediaBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('media.viewAny');
=======
    public function viewAny(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('media.viewAny'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, Media $_media): bool
    {
        return $user->hasPermissionTo('media.view');
=======
    public function view(ProfileContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.view'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('media.create');
=======
    public function create(ProfileContract $user): bool
    {
        return $user->hasPermissionTo('media.create'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, Media $_media): bool
    {
        return $user->hasPermissionTo('media.update');
=======
    public function update(ProfileContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.update'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, Media $_media): bool
    {
        return $user->hasPermissionTo('media.delete');
=======
    public function delete(ProfileContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.delete'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, Media $_media): bool
    {
        return $user->hasPermissionTo('media.restore');
=======
    public function restore(ProfileContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.restore'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.forceDelete');
=======
    public function forceDelete(ProfileContract $user, Media $media): bool
    {
        return $user->hasPermissionTo('media.forceDelete'); /** @phpstan-ignore method.nonObject */
>>>>>>> 0a466ed (.)
    }
}
