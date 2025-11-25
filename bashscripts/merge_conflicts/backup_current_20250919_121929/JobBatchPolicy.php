<?php

declare(strict_types=1);

namespace Modules\Job\Models\Policies;

use Modules\User\Models\Policies\UserBasePolicy;
use Modules\User\Models\Team;
use Modules\Xot\Contracts\UserContract;

class JobBatchPolicy extends UserBasePolicy
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
    public function view(UserContract $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $_user): bool
=======
    public function create(UserContract $user): bool
>>>>>>> e1b0bf9 (.)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(UserContract $user, Team $team): bool
<<<<<<< HEAD
    public function update(UserContract $_user): bool
=======
    public function update(UserContract $user): bool
>>>>>>> e1b0bf9 (.)
    {
        // return $user->ownsTeam($team);
        return false;
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(UserContract $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(UserContract $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(UserContract $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(UserContract $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }
}
