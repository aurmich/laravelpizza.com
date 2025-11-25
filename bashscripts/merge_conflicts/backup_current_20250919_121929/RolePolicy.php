<?php

declare(strict_types=1);

namespace Modules\User\Models\Policies;

use Modules\User\Models\Role as Post;
use Modules\Xot\Contracts\UserContract;

class RolePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(UserContract $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $_user, Post $_post): bool
=======
    public function view(UserContract $user, Post $post): bool
>>>>>>> fbc8f8e (.)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $_user): bool
=======
    public function create(UserContract $user): bool
>>>>>>> fbc8f8e (.)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $_user, Post $_post): bool
=======
    public function update(UserContract $user, Post $post): bool
>>>>>>> fbc8f8e (.)
    {
        return true;
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(UserContract $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(UserContract $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(UserContract $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $_user, Post $_post): bool
=======
    public function delete(UserContract $user, Post $post): bool
>>>>>>> fbc8f8e (.)
    {
        return true;
    }
}
