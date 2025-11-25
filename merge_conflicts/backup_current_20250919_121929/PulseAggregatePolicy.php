<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

<<<<<<< HEAD
use Override;
use Modules\Xot\Contracts\UserContract;
=======
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> f1d4085 (.)
use Modules\Xot\Models\PulseAggregate;

class PulseAggregatePolicy extends XotBasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
<<<<<<< HEAD
    #[Override]
    public function viewAny(UserContract $user): bool
=======
    public function viewAny(ProfileContract $user): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
<<<<<<< HEAD
    public function view(UserContract $user, PulseAggregate $_pulse_aggregate): bool
=======
    public function view(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.view');
    }

    /**
     * Determine whether the user can create models.
     */
<<<<<<< HEAD
    public function create(UserContract $user): bool
=======
    public function create(ProfileContract $user): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.create');
    }

    /**
     * Determine whether the user can update the model.
     */
<<<<<<< HEAD
    public function update(UserContract $user, PulseAggregate $_pulse_aggregate): bool
=======
    public function update(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
<<<<<<< HEAD
    public function delete(UserContract $user, PulseAggregate $_pulse_aggregate): bool
=======
    public function delete(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
<<<<<<< HEAD
    public function restore(UserContract $user, PulseAggregate $_pulse_aggregate): bool
=======
    public function restore(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
<<<<<<< HEAD
    public function forceDelete(UserContract $user, PulseAggregate $pulse_aggregate): bool
=======
    public function forceDelete(ProfileContract $user, PulseAggregate $pulse_aggregate): bool
>>>>>>> f1d4085 (.)
    {
        return $user->hasPermissionTo('pulse_aggregate.forceDelete');
    }
}
