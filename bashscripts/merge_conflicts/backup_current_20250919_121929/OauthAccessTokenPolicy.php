<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\OauthAccessToken;
use Modules\Xot\Contracts\UserContract;
=======

>>>>>>> fbc8f8e (.)

class OauthAccessTokenPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-access-token.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return (
            $user->hasPermissionTo('oauth-access-token.view') ||
            $user->id === $oauthAccessToken->user_id ||
            $user->hasRole('super-admin')
        );
=======

               $user->id === $oauthAccessToken->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-access-token.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, OauthAccessToken $_oauthAccessToken): bool
    {
        return $user->hasPermissionTo('oauth-access-token.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return (
            $user->hasPermissionTo('oauth-access-token.delete') ||
            $user->id === $oauthAccessToken->user_id ||
            $user->hasRole('super-admin')
        );
=======

               $user->id === $oauthAccessToken->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, OauthAccessToken $_oauthAccessToken): bool
    {
        return $user->hasPermissionTo('oauth-access-token.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, OauthAccessToken $oauthAccessToken): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-access-token.force-delete') || $user->hasRole('super-admin');
=======

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
