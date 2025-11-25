<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\OauthPersonalAccessClient;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\User\Contracts\UserContract;
use Modules\User\Models\OauthPersonalAccessClient;
>>>>>>> fbc8f8e (.)

class OauthPersonalAccessClientPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, OauthPersonalAccessClient $_oauthPersonalAccessClient): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.view') || $user->hasRole('super-admin');
=======
    public function view(UserContract $user, OauthPersonalAccessClient $oauthPersonalAccessClient): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, OauthPersonalAccessClient $_oauthPersonalAccessClient): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, OauthPersonalAccessClient $oauthPersonalAccessClient): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, OauthPersonalAccessClient $_oauthPersonalAccessClient): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, OauthPersonalAccessClient $oauthPersonalAccessClient): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, OauthPersonalAccessClient $_oauthPersonalAccessClient): bool
    {
        return $user->hasPermissionTo('oauth-personal-access-client.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, OauthPersonalAccessClient $oauthPersonalAccessClient): bool
    {
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, OauthPersonalAccessClient $oauthPersonalAccessClient): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-personal-access-client.force-delete') || $user->hasRole('super-admin');
=======
        return $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
