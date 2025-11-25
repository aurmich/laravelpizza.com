<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

<<<<<<< HEAD
use Modules\User\Models\OauthClient;
use Modules\Xot\Contracts\UserContract;
=======

>>>>>>> fbc8f8e (.)

class OauthClientPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-client.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(UserContract $user, OauthClient $oauthClient): bool
    {
<<<<<<< HEAD
        return (
            $user->hasPermissionTo('oauth-client.view') ||
            $user->id === $oauthClient->user_id ||
            $user->hasRole('super-admin')
        );
=======

               $user->id === $oauthClient->user_id ||
               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserContract $user): bool
    {
        return $user->hasPermissionTo('oauth-client.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, OauthClient $_oauthClient): bool
    {
        return $user->hasPermissionTo('oauth-client.update') || $user->hasRole('super-admin');
=======
    public function update(UserContract $user, OauthClient $oauthClient): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, OauthClient $_oauthClient): bool
    {
        return $user->hasPermissionTo('oauth-client.delete') || $user->hasRole('super-admin');
=======
    public function delete(UserContract $user, OauthClient $oauthClient): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, OauthClient $_oauthClient): bool
    {
        return $user->hasPermissionTo('oauth-client.restore') || $user->hasRole('super-admin');
=======
    public function restore(UserContract $user, OauthClient $oauthClient): bool
    {

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserContract $user, OauthClient $oauthClient): bool
    {
<<<<<<< HEAD
        return $user->hasPermissionTo('oauth-client.force-delete') || $user->hasRole('super-admin');
=======

               $user->hasRole('super-admin');
>>>>>>> fbc8f8e (.)
    }
}
